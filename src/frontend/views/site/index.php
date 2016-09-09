<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div>
        <header class="page-header">
            <h2 style="margin-top: 0;padding-top:0;">Yii2 Swoole Camera</h2>
        </header>
        <div>
            <div class="row">
                <div class="col-lg-4">
                    <img src="https://storage.test.extong.cn/file/1njchu.jpg" class="img-thumbnail">
                </div>
                <div class="col-lg-8">
                    <p>
                        <b>GitHub</b>: <?= Html::a('https://github.com/yiizh/yii2-module-swoole-camera', 'https://github.com/yiizh/yii2-module-swoole-camera') ?>
                    </p>
                    <p>使用 Swoole 和 Yii2 实现的在线摄像头。</p>
                    <p>
                        <?= Html::a('演示', ['/demos/yii2-swoole-camera'], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('源码', 'https://github.com/yiizh/yii2-module-swoole-camera', ['class' => 'btn btn-success']) ?>
                    </p>

                </div>
            </div>
        </div>
    </div>

</div>
