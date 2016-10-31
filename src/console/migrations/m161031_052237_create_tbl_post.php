<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161031_052237_create_tbl_post extends Migration
{
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'authorId'=>$this->integer()->notNull()->comment('作者 ID'),
            'title' => $this->string(200)->notNull()->comment('标题'),
            'slug' => $this->string(200)->notNull()->comment('Slug'),
            'type' => $this->smallInteger()->notNull()->defaultValue(1)->comment('类型: 1, 原创;2, 转载'),
            'originalUrl' => $this->string(200)->comment('原文链接'),
            'contentMarkdown' => $this->text()->comment('Markdown 内容'),
            'contentHtml' => $this->text()->comment('Html 内容'),
            'viewCount' => $this->integer()->notNull()->defaultValue(0)->comment('浏览量'),
            'deleted' => 'enum("Y", "N") not null default "N" comment "删除标识"',
            'publishStatus' => 'enum("published","draft") not null default "draft" comment "发布状态"',
            'publishDatetime' => $this->dateTime()->comment('发布日期'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "文章表"');

        $this->addForeignKey('fk-post-authorId-user-id',$this->tableName,'authorId','{{%user}}','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
