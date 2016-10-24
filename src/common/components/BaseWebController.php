<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BaseWebController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => $this->accessRules(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs()
            ]
        ];
    }

    public function verbs()
    {
        return [];
    }

    /**
     * @return array
     */
    public function trustActions()
    {
        return [];
    }

    /**
     * @return array
     */
    public function publicActions()
    {
        return [];
    }

    public function accessRules()
    {
        $accessRules = [];
        $publicActions = $this->publicActions();
        if (count($publicActions) > 0) {
            $accessRules[] = [
                'allow' => true,
                'actions' => in_array('*', $publicActions) ? [] : $publicActions,
            ];
        }
        return $accessRules;
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, $this->trustActions())) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}