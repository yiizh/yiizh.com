<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components;


use yii\base\Component;
use yii\base\ErrorException;
use yii\helpers\Json;
use yii\httpclient\Client;

class ModuleClient extends Component
{
    public $baseUrl = 'http://packagist.dev.yiizh.com';

    public function getModules()
    {
        $client = $this->getHttpClient();
        $response = $client->get('/module')
            ->send();
        if ($response->isOk) {
            return Json::decode($response->content);
        } else {
            throw new ErrorException('请求数据错误: ' . $response->getStatusCode());
        }
    }

    public function getModule($id)
    {
        $client = $this->getHttpClient();
        $response = $client->get('/module/view', ['id' => $id])
            ->send();
        if ($response->isOk) {
            return Json::decode($response->content);
        } else {
            throw new ErrorException('请求数据错误: ' . $response->getStatusCode());
        }
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function download($id)
    {
        $module = $this->getModule($id);
        $githubUrl = $module['github'];
        $zipUrl = $githubUrl . '/archive/' . $module['version'] . '.zip';
        $localFile = \Yii::getAlias(\Yii::$app->params['moduleAutoloadPath'] . '/../download/' . $module['id'] . '-' . $module['version'] . '.zip');
        if (!copy($zipUrl, $localFile)) {
            return false;
        }
        return $localFile;
    }

    /**
     * @return Client
     */
    protected function getHttpClient()
    {
        return new Client([
            'baseUrl' => $this->baseUrl
        ]);
    }
}