<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161118_064303_create_tbl_post_tag extends Migration
{
    public $tableName = '{{%post_tag}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'postId' => $this->integer()->notNull()->comment('文章 Id'),
            'tagId' => $this->integer()->notNull()->comment('标签 Id'),
            'PRIMARY KEY (postId, tagId)'
        ], $this->tableOptions . ' comment "文章标签表"');
        $this->addForeignKey('post_tag-postId-post-id', $this->tableName, 'postId', '{{%post}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('post_tag-tagId-tag-id', $this->tableName, 'tagId', '{{%tag}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
