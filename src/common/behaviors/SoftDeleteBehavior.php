<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\behaviors;

use yii\base\Behavior;

class SoftDeleteBehavior extends Behavior
{
    public $softDeleteAttribute = 'deleted';
    public $deletedValue = 'Y';
    public $unDeletedValue = 'N';

    /**
     * @return boolean
     */
    public function softDelete()
    {
        $owner = $this->owner;
        $owner->{$this->softDeleteAttribute} = $owner->deletedValue;
        return $owner->save(false, [$this->softDeleteAttribute]);
    }

    /**
     * @return boolean
     */
    public function softRestore()
    {
        $owner = $this->owner;
        $owner->{$this->softDeleteAttribute} = $owner->unDeletedValue;
        return $owner->save(false, [$this->softDeleteAttribute]);
    }

    /**
     * 是否软删除
     *
     * @return bool
     */
    public function getIsDeleted()
    {
        $owner = $this->owner;
        return $owner->{$this->softDeleteAttribute} == $this->deletedValue;
    }
}