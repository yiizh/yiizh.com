<?php

namespace common\models\base;

use common\models\Post;
use common\models\Tag;

/**
 * This is the model class for table "{{%post_tag}}".
 *
 * @property integer $postId
 * @property integer $tagId
 */
class BasePostTag extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postId', 'tagId'], 'required'],
            [['postId', 'tagId'], 'integer'],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['postId' => 'id']],
            [['tagId'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tagId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postId' => '文章 Id',
            'tagId' => '标签 Id',
        ];
    }
}
