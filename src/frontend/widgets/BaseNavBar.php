<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\widgets;

use yii\base\Widget;

class BaseNavBar extends Widget
{
    const EVENT_INIT = 'init';

    private $_items = [];

    /**
     * @param array $item
     * @param string $to
     */
    public function addItem($item, $to = null)
    {
        if ($to == null) {
            $this->_items[] = $item;
        } else {
            if (isset($this->_items[$to])) {
                $this->_items[$to]['items'][] = $item;
            } else {
                $this->_items[$to] = [
                    'label' => ucwords($to),
                    'items' => [
                        $item
                    ]
                ];
            }
        }
    }

    /**
     * @param array $items
     */
    public function addItems($items, $to = null)
    {
        foreach ($items as $item) {
            $this->addItem($item, $to);
        }
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return is_array($this->_items) ? $this->_items : [];
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->_items = $items;
    }
}