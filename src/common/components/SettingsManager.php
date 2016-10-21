<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components;


use common\auth\clients\Weibo;
use common\models\Settings;
use yii\authclient\Collection;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class SettingsManager extends Component implements BootstrapInterface
{
    private $_settings = [];

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        /**
         * @var $models Settings[]
         */
        $models = Settings::find()->all();

        foreach ($models as $model) {
            $this->_settings[$model->code] = $model->getValue();
        }

        $this->initDefaultValues();
    }

    public function initDefaultValues()
    {
        /**
         * @var $authClientCollection Collection
         */
        $type = [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'weibo' => [
                    'class' => Weibo::className(),
                    'title' => '新浪微博',
                    'clientId' => $this->get(Settings::WEIBO_APP_KEY),
                    'clientSecret' => $this->get(Settings::WEIBO_APP_SECRET)
                ],
            ],
        ];
        \Yii::$app->set('authClientCollection', $type);
    }

    /**
     * @param $code
     * @param $defaultValue
     * @return mixed
     */
    public function get($code, $defaultValue = null)
    {
        return ArrayHelper::getValue($this->_settings, $code, $defaultValue);
    }
}