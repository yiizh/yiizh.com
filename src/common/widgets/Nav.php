<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\widgets;


use yii\helpers\ArrayHelper;

class Nav extends \yii\bootstrap\Nav
{
    public $menuId;

    public function init()
    {
        parent::init();
        if(isset($this->menuId)){
            $this->items = self::getMenu($this->menuId);
        }
    }

    /**
     * 设置菜单
     *
     * @param string $menuId 菜单编号
     * @param array $menuItems 菜单项
     */
    public static function setMenu($menuId, array $menuItems = [])
    {
        \Yii::$app->getView()->params['menus'][$menuId] = $menuItems;
    }

    /**
     * 获取菜单
     *
     * @param string $menuId
     * @return array
     */
    public static  function getMenu($menuId)
    {
        return ArrayHelper::getValue(\Yii::$app->getView()->params, "menus.{$menuId}", []);
    }

    /**
     * 添加菜单项
     *
     * @param string $menuId 菜单编号
     * @param string|array $menuItem 菜单项
     */
    public static  function addMenuItem($menuId, $menuItem)
    {
        $menu = static::getMenu($menuId);
        $menu[] = $menuItem;
        \Yii::$app->getView()->params['menus'][$menuId] = $menu;
    }
}