<?php

namespace common\models;

use common\behaviors\PostBehavior;
use common\behaviors\SoftDeleteBehavior;
use common\models\base\BasePost;
use yii\helpers\ArrayHelper;
use yii\helpers\Markdown;
use yii\helpers\Url;

/**
 * @method softDelete() boolean 软删除
 * @method softRestore() boolean 恢复
 * @method getIsDeleted() boolean 是否已删除
 * @property User $author
 */
class Post extends BasePost
{
    const PUBLISH_STATUS_PUBLISHED = 'published';
    const PUBLISH_STATUS_DRAFT = 'draft';

    const TYPE_ORIGINAL = 1;
    const TYPE_REPOST = 2;

    const EVENT_AFTER_PUBLISH = 'afterPublish';

    private $_oldTags;
    public $tags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [
            'tags', 'filter', 'filter' => function ($value) {
                return preg_split('/\s*,\s*/', $value, -1, PREG_SPLIT_NO_EMPTY);
            }
        ];
        return $rules;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors[] = [
            'class' => SoftDeleteBehavior::className()
        ];
        $behaviors[] = [
            'class' => PostBehavior::className()
        ];
        return $behaviors;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'authorId']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostQuery(get_called_class());
    }

    /**
     * @inheritDoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $tags = Tag::find()
            ->from(Tag::tableName() . ' as tag')
            ->innerJoin(PostTag::tableName() . ' as postTag', 'postTag.tagId = tag.id')
            ->andWhere(['postTag.postId' => $this->id])
            ->all();
        $this->tags = $this->_oldTags = ArrayHelper::getColumn($tags, 'name');
    }

    public function beforeSave($insert)
    {
        $this->contentHtml = Markdown::process($this->contentMarkdown, 'gfm');
        return parent::beforeSave($insert);
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['type'] = '类型';
        $labels['author.name'] = '作者';
        $labels['typeLabel'] = '类型';
        $labels['publishStatusLabel'] = '发布状态';
        $labels['tags'] = '标签';

        return $labels;
    }

    /**
     * @param bool $scheme
     * @return string
     */
    public function getUrl($scheme = false)
    {
        return Url::to(['/post/post/view', 'id' => $this->id, 'slug' => $this->slug], $scheme);
    }

    /**
     * @return array
     */
    public static function getTypeItems()
    {
        return [
            self::TYPE_ORIGINAL => '原创',
            self::TYPE_REPOST => '转载'
        ];
    }

    /**
     * @param int $type
     * @return string|null
     */
    public static function typeLabel($type)
    {
        return ArrayHelper::getValue(static::getTypeItems(), $type);
    }

    /**
     * @return null|string
     */
    public function getTypeLabel()
    {
        return static::typeLabel($this->type);
    }

    /**
     * @return array
     */
    public static function getPublishStatusItems()
    {
        return [
            self::PUBLISH_STATUS_PUBLISHED => '发布',
            self::PUBLISH_STATUS_DRAFT => '草稿'
        ];
    }

    /**
     * @param string $publishStatus
     * @return null|string
     */
    public static function publishStatusLabel($publishStatus)
    {
        return ArrayHelper::getValue(static::getPublishStatusItems(), $publishStatus);
    }

    /**
     * @return null|string
     */
    public function getPublishStatusLabel()
    {
        return self::publishStatusLabel($this->publishStatus);
    }

    /**
     * 纯文本内容
     * @return string
     */
    public function getPureContent()
    {
        return preg_replace('/\s*/', '', strip_tags($this->contentHtml));
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $oldStatus = ArrayHelper::getValue($changedAttributes, 'publishStatus');
        if ($oldStatus != self::PUBLISH_STATUS_PUBLISHED && $this->publishStatus == self::PUBLISH_STATUS_PUBLISHED) {
            $this->trigger(self::EVENT_AFTER_PUBLISH);
        }

        $this->updateTags($this->_oldTags, $this->tags);
    }

    public function updateTags(array $oldTags, array $newTags)
    {
        $addTags = array_diff($newTags, $oldTags);
        $removeTags = array_diff($oldTags, $newTags);

        $this->addTags($addTags);
        $this->removeTags($removeTags);
    }

    /**
     * 增加标签
     * @param array $tags
     */
    public function addTags(array $tags)
    {
        foreach ($tags as $name) {
            $tag = Tag::getOrCreate($name);
            if (!PostTag::find()->andWhere(['tagId' => $tag->id, 'postId' => $this->id])->exists()) {
                $postTag = new PostTag();
                $postTag->postId = $this->id;
                $postTag->tagId = $tag->id;
                $postTag->save();
            }
        }
    }

    /**
     * 删除标签
     * @param array $tags
     */
    public function removeTags(array $tags)
    {
        foreach ($tags as $name) {
            $tag = Tag::getOrCreate($name);
            if (PostTag::find()->andWhere(['tagId' => $tag->id, 'postId' => $this->id])->exists()) {
                PostTag::deleteAll(['tagId' => $tag->id, 'postId' => $this->id]);
            }
        }
    }
}
