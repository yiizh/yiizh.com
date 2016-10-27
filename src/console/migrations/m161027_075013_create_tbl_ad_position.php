<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161027_075013_create_tbl_ad_position extends Migration
{
    public $tableName = '{{%ad_position}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'code' => $this->string(200)->notNull()->comment('代号'),
            'name' => $this->string(200)->notNull()->comment('名称'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "广告位置表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
