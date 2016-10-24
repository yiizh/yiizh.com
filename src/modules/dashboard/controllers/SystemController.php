<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers;

use common\models\Settings;
use common\widgets\Alert;
use common\widgets\Nav;
use modules\dashboard\Controller;
use Yii;
use yii\base\Model;

class SystemController extends Controller
{
    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            ['label' => '站点设置', 'url' => ['system/index']],
            ['label' => '微博设置', 'url' => ['system/weibo']],
        ]);
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

        return $this->render('index', [
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