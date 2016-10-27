<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Ad;
use yii\helpers\Html;

/**
 * @var $ads Ad[]
 */

$items = [];
foreach ($ads as $ad) {
    $items[] = Html::tag('div', $ad->content, ['class' => 'ad']);
}
?>
<?= implode('<hr>', $items) ?>
