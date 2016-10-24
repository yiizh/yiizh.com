<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard;

use common\components\BaseWebController;

class Controller extends BaseWebController
{
    public function accessRules()
    {
        return [
            ['allow' => true, 'roles' => ['manager']]
        ];
    }

}