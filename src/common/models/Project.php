<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\behaviors\SoftDeleteBehavior;
use common\helpers\StringHelper;
use common\models\base\BaseProject;
use yii\helpers\Url;

/**
 * @method softDelete() boolean 软删除
 * @method softRestore() boolean 恢复
 * @method getIsDeleted() boolean 是否已删除
 */
class Project extends BaseProject
{
    /**
     * @inheritdoc
     * @return \common\models\query\ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProjectQuery(get_called_class());
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors[] = [
            'class' => SoftDeleteBehavior::className()
        ];

        return $behaviors;
    }

    /**
     * @param bool $scheme
     * @return string
     */
    public function getUrl($scheme = false)
    {
        return Url::to(['/project/project/view', 'id' => $this->id], $scheme);
    }
}
