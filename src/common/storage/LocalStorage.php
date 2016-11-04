<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\storage;

use common\helper\StringHelper;
use yii\base\Component;

class LocalStorage extends Component implements StorageInterface
{
    public $path;

    /**
     * @param string $filename
     * @return bool|string
     */
    public function getFilename($filename)
    {
        $filename = StringHelper::normalizeFilename($filename);
        return \Yii::getAlias("{$this->path}/{$filename}");
    }

    /**
     * @inheritDoc
     */
    public function write($filename, $contents)
    {
        $filename = $this->getFilename($filename);
        $dirname = dirname($filename);
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, true);
        }
        return file_put_contents($filename, $contents) !== false;
    }

    /**
     * @inheritDoc
     */
    public function read($filename)
    {
        $filename = $this->getFilename($filename);
        if (!file_exists($filename)) {
            return false;
        }
        return file_get_contents($filename);
    }

    /**
     * @inheritDoc
     */
    public function delete($filename)
    {
        $filename = $this->getFilename($filename);
        if (!file_exists($filename)) {
            return true;
        }
        return unlink($filename);
    }
}