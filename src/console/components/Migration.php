<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\components;


class Migration extends \yii\db\Migration
{
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    protected function addSettings(array $settings)
    {
        foreach ($settings as $setting) {
            $this->insert('{{%settings}}', $setting);
        }
    }

    protected function removeSettings(array $settings)
    {
        foreach ($settings as $code) {
            $this->delete('{{%settings}}', 'code=:code', [':code' => $code]);
        }
    }
}