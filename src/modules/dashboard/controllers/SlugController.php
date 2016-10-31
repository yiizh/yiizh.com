<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers;


use modules\dashboard\Controller;
use yii\helpers\Inflector;
use yii\web\Response;

class SlugController extends Controller
{
    public function publicActions()
    {
        return ['*'];
    }

    /**
     * @param null $string
     * @return array
     */
    public function actionIndex($string = null)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'slug' => Inflector::slug($string),
        ];
    }
}