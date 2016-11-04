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
use yii\helpers\Html;

class SystemController extends Controller
{
    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            ['label' => '站点设置', 'url' => ['system/index']],
            ['label' => '备案号', 'url' => ['system/beian']],
            ['label' => 'End Body 代码块', 'url' => ['system/block-end-body']],
            ['label' => '微博设置', 'url' => ['system/weibo']],
            ['label' => '统计代码', 'url' => ['system/tongji']],
            ['label' => '淘宝推广', 'url' => ['system/taobao-union']],
            ['label' => '百度', 'url' => ['system/baidu']],
            ['label' => '阿里云', 'url' => ['system/aliyun']],
            ['label' => '邮件设置', 'url' => ['system/email']],
        ]);
    }

    public function accessRules()
    {
        $rules[] = [
            'allow' => true,
            'roles' => ['manageSystem']
        ];
        return $rules;
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

    public function actionTongji()
    {
        $settings = [
            Settings::findOneByCode(Settings::TONGJI_CNZZ),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        echo Html::errorSummary($settings);

        return $this->render('tongji', [
            'settings' => $settings
        ]);
    }

    public function actionTaobaoUnion()
    {
        $settings = [
            Settings::findOneByCode(Settings::TAOBAO_UNION),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('taobao-union', [
            'settings' => $settings
        ]);
    }

    public function actionBeian()
    {
        $settings = [
            Settings::findOneByCode(Settings::BEIAN),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('beian', [
            'settings' => $settings
        ]);
    }

    public function actionBlockEndBody()
    {
        $settings = [
            Settings::findOneByCode(Settings::BLOCK_END_BODY),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('block-end-body', [
            'settings' => $settings
        ]);
    }

    public function actionBaidu()
    {
        $settings = [
            Settings::findOneByCode(Settings::BAIDU_PING_SITE),
            Settings::findOneByCode(Settings::BAIDU_PING_TOKEN),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('baidu', [
            'settings' => $settings
        ]);
    }

    public function actionAliyun()
    {
        $settings = [
            Settings::findOneByCode(Settings::ALIYUN_ACCESS_KEY_ID),
            Settings::findOneByCode(Settings::ALIYUN_ACCESS_KEY_SECRET),
            Settings::findOneByCode(Settings::ALIYUN_ENDPOINT),
            Settings::findOneByCode(Settings::ALIYUN_BUCKET),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('aliyun', [
            'settings' => $settings
        ]);
    }

    public function actionEmail()
    {
        $settings = [
            Settings::findOneByCode(Settings::EMAIL_FROM_NAME),
            Settings::findOneByCode(Settings::EMAIL_FROM_EMAIL),
            Settings::findOneByCode(Settings::EMAIL_SMTP_HOST),
            Settings::findOneByCode(Settings::EMAIL_USERNAME),
            Settings::findOneByCode(Settings::EMAIL_PASSWORD),
            Settings::findOneByCode(Settings::EMAIL_PORT),
            Settings::findOneByCode(Settings::EMAIL_ENCRYPTION),
        ];

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Alert::set('success', '保存成功');
            return $this->refresh();
        }

        return $this->render('email', [
            'settings' => $settings
        ]);
    }
}