<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace libs\aliyun;


use common\helper\StringHelper;
use common\storage\StorageInterface;
use OSS\OssClient;
use yii\base\Component;
use yii\log\Logger;

class AliyunStorage extends Component implements StorageInterface
{
    /**
     * @var string
     */
    public $accessKeyId;

    /**
     * @var string
     */
    public $accessKeySecret;

    /**
     * @var string
     */
    public $endpoint;

    /**
     * @var string
     */
    public $bucket;

    /**
     * @var OssClient
     */
    protected $ossClient;

    public function init()
    {
        parent::init();

        $this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
    }

    /**
     * @return mixed
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * @param mixed $bucket
     */
    public function setBucket($bucket)
    {
        $this->bucket = $bucket;
    }

    /**
     * @return OssClient
     */
    public function getClient()
    {
        return $this->ossClient;
    }

    /**
     * @param OssClient $client
     */
    public function setClient($client)
    {
        $this->ossClient = $client;
    }

    public function getFilename($filename)
    {
        return StringHelper::normalizeFilename($filename);
    }

    /**
     * @inheritDoc
     */
    public function write($filename, $contents)
    {
        $filename = $this->getFilename($filename);
        try {
            $this->ossClient->putObject($this->bucket, $filename, $contents);
            return true;
        } catch (\Exception $exception) {
            \Yii::getLogger()->log($exception->getTraceAsString(), Logger::LEVEL_ERROR);
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function read($filename)
    {
        $filename = $this->getFilename($filename);
        return $this->ossClient->getObject($this->bucket, $filename);
    }

    /**
     * @inheritDoc
     */
    public function delete($filename)
    {
        $filename = $this->getFilename($filename);
        try {
            $this->ossClient->deleteObject($this->bucket, $filename);
            return true;
        } catch (\Exception $exception) {
            \Yii::getLogger()->log($exception->getTraceAsString(), Logger::LEVEL_ERROR);
            return false;
        }
    }
}