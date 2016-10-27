<?php

namespace common\models\base;

use common\models\Ad;
use common\models\AdPosition;

/**
 * This is the model class for table "{{%ad_position_item}}".
 *
 * @property integer $positionId
 * @property integer $adId
 */
class BaseAdPositionItem extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_position_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['positionId', 'adId'], 'required'],
            [['positionId', 'adId'], 'integer'],
            [['adId'], 'exist', 'skipOnError' => true, 'targetClass' => Ad::className(), 'targetAttribute' => ['adId' => 'id']],
            [['positionId'], 'exist', 'skipOnError' => true, 'targetClass' => AdPosition::className(), 'targetAttribute' => ['positionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'positionId' => '广告位置 ID',
            'adId' => '广告 ID',
        ];
    }
}
