<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\storage;

/**
 * @package common\storage
 *
 * @method static UploadedFile getInstanceByName($name)
 * @method static UploadedFile getInstance($model, $attribute)
 * @method static UploadedFile[] getInstances($model, $attribute)
 * @method static UploadedFile[] getInstancesByName($name)
 */
class UploadedFile extends \yii\web\UploadedFile
{
    /**
     * @inheritDoc
     */
    public function saveAs($file, $deleteTempFile = true)
    {
        if ($this->error == UPLOAD_ERR_OK) {
            /**
             * @var $storage StorageInterface
             */
            $storage = \Yii::$app->storage;
            if (!$storage->write($file, file_get_contents($this->tempName))) {
                return false;
            }
            if ($deleteTempFile) {
                unlink($this->tempName);
            }
            return true;
        }
        return false;
    }

}