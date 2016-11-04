<?php

namespace common\models;

use common\behaviors\NewsBehavior;
use common\models\base\BaseNews;
use common\models\query\NewsQuery;
use common\models\query\ProjectQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @property User $user
 * @property Project|null $project
 * @property string $content
 */
class News extends BaseNews
{
    const STATUS_PROPOSED = 1;
    const STATUS_PUBLISHED = 10;
    const STATUS_REJECTED = 0;

    const SCENARIO_SUGGEST = 'suggest';
    const SCENARIO_UPDATE = 'update';

    const TYPE_DEFAULT = 1;
    const TYPE_PROJECT = 2;
    const TYPE_HEADLINE = 3;

    const EVENT_AFTER_PUBLISH = 'afterPublish';

    public $projectName;

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SUGGEST] = ['title', 'summary', 'link', 'type'];
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['type', 'required'];
        $rules[] = ['link', 'url'];
        $rules[] = ['link', 'validateLink', 'skipOnEmpty' => false];
        $rules[] = ['projectName', 'validateProject', 'skipOnEmpty' => false];
        $rules[] = ['projectId', 'validateProject', 'skipOnEmpty' => false];

        return $rules;
    }

    public function validateLink($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->type == self::TYPE_HEADLINE && $this->link == '') {
                $this->addError($attribute, '请填写链接地址');
            }
        }
    }

    public function validateProject($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->type == self::TYPE_PROJECT && ($this->projectId == '' || $this->projectName == '')) {
                $this->addError($attribute, '请填写相关项目');
            }
        }
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['projectName'] = '相关项目';
        return $labels;
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($this->project) {
            $this->projectName = $this->project->name;
        }
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => NewsBehavior::className()
        ];
        return $behaviors;
    }

    /**
     * @return ProjectQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'projectId']);
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return static::statusLabel($this->status);
    }

    /**
     * @param int $status
     * @return string
     */
    public static function statusLabel($status)
    {
        $statuses = static::getStatusItems();
        return ArrayHelper::getValue($statuses, $status);
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_PROPOSED => '投稿',
            self::STATUS_PUBLISHED => '发布',
            self::STATUS_REJECTED => '拒绝',
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
     * @return array
     */
    public static function getTypeItems()
    {
        return [
            self::TYPE_DEFAULT => '综合资讯',
            self::TYPE_PROJECT => '开源项目更新',
            self::TYPE_HEADLINE => '头条',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $oldStatus = ArrayHelper::getValue($changedAttributes, 'status');
        if ($oldStatus != self::STATUS_PUBLISHED && $this->status == self::STATUS_PUBLISHED) {
            $this->trigger(self::EVENT_AFTER_PUBLISH);
        }

    }

    /**
     * @param bool $scheme
     * @return string
     */
    public function getUrl($scheme = false)
    {
        return Url::to(['/news/news/view', 'id' => $this->id], $scheme);
    }

    /**
     * @return null|string
     */
    public function getTypeLabel()
    {
        return self::typeLabel($this->type);
    }

    /**
     * @param bool $scheme
     * @return string
     */
    public function getTypeUrl($scheme = false)
    {
        return Url::to(['/news/news/index', 'type' => $this->type], $scheme);
    }

    /**
     * @param bool $scheme
     * @param array $options
     * @return string
     */
    public function getTypeLink($scheme = false, $options = [])
    {
        return Html::a($this->getTypeLabel(), $this->getTypeUrl($scheme), $options);
    }
}
