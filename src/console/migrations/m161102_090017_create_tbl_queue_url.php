<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161102_090017_create_tbl_queue_url extends Migration
{
    public $tableName = '{{%queue_url}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'url' => $this->string(200)->notNull()->comment('URL'),
            'status' => 'enum("pending","pushed") not null default "pending" comment "状态"',
            'pushDatetime' => $this->dateTime()->comment('推送时间'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "URL 队列表(等待推送到搜索引擎的URL)"');

    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
