<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\content;


class Controller extends \modules\dashboard\Controller
{
    public function verbs()
    {
        return [
            ['allow' => true, 'roles' => ['manageContentPool']]
        ];
    }
}