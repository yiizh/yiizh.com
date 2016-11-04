<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161103_073816_create_tbl_file extends Migration
{
    public $tableName = '{{%file}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'uploaderId' => $this->integer()->notNull()->comment('上传者'),
            'name' => $this->string(200)->notNull()->comment('文件名'),
            'path' => $this->string(200)->comment('存储路径'),
            'mimeType' => $this->string(200)->comment('Mime Type'),
            'extension' => $this->string(50)->comment('扩展名'),
            'size' => $this->integer()->comment('文件大小'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "文件表"');

        $this->addForeignKey('fk-file-uploaderId-user-id', $this->tableName, 'uploaderId', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
