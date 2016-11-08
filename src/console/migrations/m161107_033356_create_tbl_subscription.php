<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161107_033356_create_tbl_subscription extends Migration
{
    public $tableName = '{{%subscription}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'url' => $this->string(200)->notNull()->comment('URL 地址'),
            'channelTitle' => $this->string(200)->comment('频道标题'),
            'link' => $this->string(200)->comment('链接'),
            'description' => $this->string(500)->comment('描述'),
            'modifyDatetime' => $this->dateTime()->comment('修改时间'),
            'lastUpdatedAt' => $this->integer()->comment('上次更新时间'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "内部订阅表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
