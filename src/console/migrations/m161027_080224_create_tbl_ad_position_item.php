<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161027_080224_create_tbl_ad_position_item extends Migration
{
    public $tableName = '{{%ad_position_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'positionId' => $this->integer()->notNull()->comment('广告位置 ID'),
            'adId' => $this->integer()->notNull()->comment('广告 ID'),
        ], $this->tableOptions . ' comment "广告位置广告表"');

        $this->addForeignKey('fk-ad_position_item-ad_position-positionId', $this->tableName, 'positionId', '{{%ad_position}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-ad_position_item-ad-adId', $this->tableName, 'adId', '{{%ad}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
