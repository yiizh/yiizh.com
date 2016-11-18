<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BaseTag;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property integer $id
 * @property string $name
 */
class Tag extends BaseTag
{
    /**
     * @inheritdoc
     * @return \common\models\query\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TagQuery(get_called_class());
    }

    /**
     * @param string $name
     * @return Tag|null
     */
    public static function getOrCreate($name)
    {
        $attributes = [
            'name' => $name
        ];
        if (static::find()->andWhere($attributes)->exists()) {
            return static::find()->andWhere($attributes)->one();
        } else {
            $model = new static($attributes);
            if ($model->save()) {
                return $model;
            }
        }
        return false;
    }
}
