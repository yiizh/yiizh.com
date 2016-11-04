<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\helper\FileHelper;
use common\models\base\BaseFile;
use common\storage\UploadedFile;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 *
 * @property User $uploader
 */
class File extends BaseFile
{
    const SCENARIO_UPLOAD = 'upload';
    /**
     * @var UploadedFile
     */
    public $file;

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['file'] = '文件';
        $labels['uploader.name'] = '上传者';
        return $labels;
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['name', 'filter', 'filter' => 'trim'];
        $rules[] = ['file', 'file', 'skipOnEmpty' => false, 'on' => self::SCENARIO_UPLOAD];
        return $rules;
    }

    /**
     * @inheritdoc
     * @return \common\models\query\FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FileQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploader()
    {
        return $this->hasOne(User::className(), ['id' => 'uploaderId']);
    }

    /**
     * @param bool $scheme
     * @return string
     */
    public function getUrl($scheme = false)
    {
        $url = [
            '/file/view',
            'id' => $this->id,
            'name' => $this->name
        ];
        if ($this->extension) {
            $url['extension'] = $this->extension;
        }

        return Url::to($url, $scheme);
    }

    /**
     * @return string|false
     */
    public function getContent()
    {
        return \Yii::$app->storage->read($this->path);
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        if ($this->extension) {
            return $this->name . '.' . $this->extension;
        } else {
            return $this->name;
        }
    }

    /**
     * @return bool
     */
    public function getIsInline()
    {
        return FileHelper::getIsInlineByExtension($this->extension) || FileHelper::getIsInlineByMimeType($this->mimeType);
    }

    /**
     * @return bool
     */
    public function getIsImage()
    {
        return FileHelper::getIsImageByExtension($this->extension) || FileHelper::getIsImageByMimeType($this->mimeType);
    }

    public function upload()
    {
        $file = $this->file = UploadedFile::getInstance($this, 'file');

        if (!$this->validate()) {
            return false;
        }
        $dir = date('Y/m/d');
        $fileName = $dir . '/' . md5(Yii::$app->security->generateRandomString()) . '.' . $file->extension;

        if ($file->saveAs($fileName)) {
            $this->mimeType = $file->type;
            $this->extension = $file->extension;
            $this->path = $fileName;
            $this->uploaderId = Yii::$app->user->id;
            $this->size = $file->size;

            return $this->save();
        }
        return false;
    }

    /**
     * @return string
     */
    public function getShortPreview()
    {
        return $this->getIsImage() ? Html::img($this->getUrl(), [
            'style' => 'max-height: 200px;max-width: 200px;'
        ]) : Html::a($this->getFilename(), $this->getUrl());
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Yii::$app->storage->delete($this->path);
    }
}
