<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\clients\baidu;

use common\models\Settings;
use yii\base\Component;
use yii\helpers\Json;
use yii\httpclient\Client;

class Baidu extends Component
{
    public $pingSite;
    public $pingToken;

    public function init()
    {
        parent::init();

        if ($this->pingSite == null) {
            $this->pingSite = Settings::get(Settings::BAIDU_PING_SITE);
        }
        if ($this->pingToken == null) {
            $this->pingToken = Settings::get(Settings::BAIDU_PING_TOKEN);
        }
    }

    public function ping($urls)
    {
        $client = new Client();
        $request = $client->createRequest()
            ->setUrl("http://data.zz.baidu.com/urls?site={$this->pingSite}&token={$this->pingToken}")
            ->setContent(implode("\n", $urls))
            ->addHeaders(['Content-Type' => 'text/plain'])
            ->setMethod('post');

        $resp = $request->send();

        if ($resp->isOk) {
            return Json::decode($resp->content);
        } else {
            return [
                'success' => false,
                'message' => $resp->statusCode
            ];
        }
    }
}