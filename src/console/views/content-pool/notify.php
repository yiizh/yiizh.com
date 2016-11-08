<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\ContentPool;
use yii\base\View;
use yii\helpers\Html;

/**
 * @var $this View
 * @var $models ContentPool[]
 */
?>
<?php foreach ($models as $model): ?>
    <article>
        <header>
            <h1><?= Html::a($model->title, $model->url, ['target' => '_blank']) ?></h1>
        </header>
        <footer>
            发布时间: <?= $model->publishDatetime ?> <?= Html::encode($model->from) ?>
        </footer>
    </article>
<?php endforeach; ?>