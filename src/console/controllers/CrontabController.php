<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class CrontabController extends Controller
{
    /**
     * @var \swoole_server
     */
    public $server;
    public $port = 9051;
    public $crontabs = [

    ];

    public $queue = [];

    public function init()
    {
        parent::init();
        $this->crontabs = ArrayHelper::getValue(\Yii::$app->params, 'crontabs', []);
    }

    public function actionStartup()
    {
        $this->server = new \swoole_server('0.0.0.0', $this->port);

        $this->server->set([
            'task_worker_num' => 4
        ]);

        $this->server->on('start', [$this, 'onStart']);
        $this->server->on('workerStart', [$this, 'onWorkerStart']);
        $this->server->on('connect', [$this, 'onConnect']);
        $this->server->on('receive', [$this, 'onReceive']);
        $this->server->on('task', [$this, 'onTask']);
        $this->server->on('finish', [$this, 'onFinish']);
        $this->server->on('close', [$this, 'close']);

        $this->server->start();
    }

    public function onStart(\swoole_server $server)
    {
        echo "Server started." . PHP_EOL;
    }

    public function onWorkerStart(\swoole_server $server, $worker_id)
    {
        if ($worker_id == 0) {
            foreach ($this->crontabs as $crontabIndex => $crontab) {
                $nextExecTime = $this->getNextCronTabExecTime($crontab['rule']);
                $crontabArgs = ArrayHelper::getValue($crontab, 'args', []);
                $args = [];
                foreach ($crontabArgs as $param => $value) {
                    if (is_integer($param)) {
                        $args[] = \Yii::getAlias($value);
                    } elseif (is_string($param)) {
                        $args[] = \Yii::getAlias($param) . '=' . \Yii::getAlias($value);
                    }
                }
                $this->queue[$nextExecTime] = [
                    'rule' => $crontab['rule'],
                    'cmd' => $crontab['cmd'] . ' ' . implode(' ', $args),
                ];

            }
            $server->tick(1000, function () use ($server) {
                foreach ($this->queue as $key => $queue) {
//                    echo $key . ':' . time() . PHP_EOL;
                    if ($key == time()) {
                        $server->task(Json::encode([
                            'task' => 'cmd',
                            'params' => [
                                'cmd' => $queue['cmd']
                            ]
                        ]));
                        unset($this->queue[$key]);
                        $this->queue[$this->getNextCronTabExecTime($queue['rule'])] = [
                            'rule' => $queue['rule'],
                            'cmd' => $queue['cmd'],
                        ];
                    }

                }
            });
        }
    }

    public function onConnect()
    {

    }

    public function onReceive()
    {

    }

    public function onTask(\swoole_server $server, $taskId, $fromId, $data)
    {
        $data = Json::decode($data);
        $result = [
            'success' => false
        ];

        if (ArrayHelper::getValue($data, 'task') == 'cmd') {
            $cmd = ArrayHelper::getValue($data, 'params.cmd');
            if ($cmd != null) {
                echo "Run command \"{$cmd}\"" . PHP_EOL;

                try {
                    exec($cmd, $output, $return);
                    if ($return != 0) {
                        $result = [
                            'success' => false,
                            'message' => implode(PHP_EOL, $output)
                        ];
                    } else {
                        $result = [
                            'success' => true,
                            'message' => implode(PHP_EOL, $output)
                        ];
                    }
                } catch (\Exception $e) {
                    $result = [
                        'success' => false,
                        'message' => "Error on Task: {$taskId}, {$e->getMessage()}"
                    ];
                }
            }
        }

        return Json::encode($result);

    }

    public function onFinish(\swoole_server $serv, $task_id, $data)
    {
        $data = Json::decode($data);
        if ($data['success']) {
            echo "执行 \"{$task_id}\" 成功: " . PHP_EOL . $data['message'] . PHP_EOL;
        } else {
            echo "执行 \"{$task_id}\" 失败: " . PHP_EOL . $data['message'] . PHP_EOL;
        }
    }

    public function onClose(\swoole_server $server, $fd, $from_id)
    {
        echo "Connect {$fd} closed." . PHP_EOL;
    }

    /**
     * 从 cronTab 中获取下一次执行命令的时间
     *
     * @param string $cronTab
     * @param null $timestamp 时间戳，默认为当前时间
     * @return int
     */
    protected function getNextCronTabExecTime($cronTab, $timestamp = null)
    {
        if (!preg_match('/^((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)$/i',
            trim($cronTab))
        ) {
            throw new \InvalidArgumentException("Invalid cron string: " . $cronTab);
        }
        if ($timestamp && !is_numeric($timestamp)) {
            throw new \InvalidArgumentException("\$_after_timestamp must be a valid unix timestamp ($timestamp given)");
        }
        $cron = preg_split('/[\s]+/i', trim($cronTab));
        $start = empty($timestamp) ? time() : $timestamp;
        $date = array(
            'minutes' => self::parseCronNumbers($cron[0], 0, 59),
            'hours' => self::parseCronNumbers($cron[1], 0, 23),
            'dom' => self::parseCronNumbers($cron[2], 1, 31),
            'month' => self::parseCronNumbers($cron[3], 1, 12),
            'dow' => self::parseCronNumbers($cron[4], 0, 6),
        );
        // 查询一年内的时间，从下一分钟开始
        for ($i = 60; $i <= 60 * 60 * 24 * 366; $i += 60) {
            if (in_array(intval(date('j', $start + $i)), $date['dom']) &&
                in_array(intval(date('n', $start + $i)), $date['month']) &&
                in_array(intval(date('w', $start + $i)), $date['dow']) &&
                in_array(intval(date('G', $start + $i)), $date['hours']) &&
                in_array(intval(date('i', $start + $i)), $date['minutes'])
            ) {
                return $start + $i;
            }
        }
        return null;
    }

    /**
     * get a single cron style notation and parse it into numeric value
     *
     * @param string $s cron string element
     * @param int $min minimum possible value
     * @param int $max maximum possible value
     * @return array parsed number
     */
    protected static function parseCronNumbers($s, $min, $max)
    {
        $result = array();
        $v = explode(',', $s);
        foreach ($v as $vv) {
            $vvv = explode('/', $vv);
            $step = empty($vvv[1]) ? 1 : $vvv[1];
            $vvvv = explode('-', $vvv[0]);
            $_min = count($vvvv) == 2 ? $vvvv[0] : ($vvv[0] == '*' ? $min : $vvv[0]);
            $_max = count($vvvv) == 2 ? $vvvv[1] : ($vvv[0] == '*' ? $max : $vvv[0]);
            for ($i = $_min; $i <= $_max; $i += $step) {
                $result[$i] = intval($i);
            }
        }
        ksort($result);
        return $result;
    }
}