<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers\manage;


use common\models\Settings;
use common\widgets\Alert;
use frontend\components\BaseManageController;
use Yii;
use yii\base\Model;

class SystemController extends BaseManageController
{
    public $layout = 'manage/sidebar';

    public function init()
    {
        parent::init();
        $this->getView()->params['sidebar'] = [
            'title' => '系统设置',
            'items' => [
                ['label' => '站点设置', 'url' => ['/manage/system/index']],
                ['label' => '微博设置', 'url' => ['/manage/system/weibo']],
            ]
        ];
    }

    public function actionIndex()
    {
        $settings = Settings::getSiteSettings();

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('index',[
            'settings' => $settings
        ]);
    }

    /**
     * 微博设置
     *
     * @return string
     */
    public function actionWeibo()
    {
        $settings = [
            Settings::findOneByCode(Settings::WEIBO_APP_KEY),
            Settings::findOneByCode(Settings::WEIBO_APP_SECRET),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('weibo', [
            'settings' => $settings
        ]);
    }
}