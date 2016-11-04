<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161104_053953_create_tbl_mail_content extends Migration
{
    public $tableName = '{{%mail_content}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'subject' => $this->string(200)->comment('主题'),
            'body' => $this->text()->comment('内容'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "邮件内容表"');

    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
