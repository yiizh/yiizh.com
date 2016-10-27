<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\widgets;


use common\models\AdPosition;
use yii\base\Widget;

class AdPositionWidget extends Widget
{
    /**
     * @var string 广告位代号
     */
    public $code;
    public $limit = 2;

    public function run()
    {
        $position = AdPosition::find()->andWhere(['code'=>$this->code])->one();
        if($position){
            return $this->render('ad-position',[
                'ads'=>$position->getAds()->limit($this->limit)->all()
            ]);
        }

    }
}