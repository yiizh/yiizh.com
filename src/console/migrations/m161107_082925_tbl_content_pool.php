<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\ContentPool;
use console\components\Migration;

class m161107_082925_tbl_content_pool extends Migration
{
    public $tableName = '{{%content_pool}}';

    public function up()
    {
        $statuses = [
            ContentPool::STATUS_TODO,
            ContentPool::STATUS_IGNORE,
            ContentPool::STATUS_PUBLISHED
        ];
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'url' => $this->string(200)->notNull()->comment('URL 地址'),
            'title' => $this->string(200)->comment('标题'),
            'description' => $this->text()->comment('内容'),
            'from' => $this->string(100)->comment('来源'),
            'status' => 'enum("' . implode('","', $statuses) . '") not null default "' . ContentPool::STATUS_TODO . '" comment "状态"',
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "内容库表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
