<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161026_024846_create_tbl_project extends Migration
{
    public $tableName = '{{%project}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'name' => $this->string(200)->notNull()->comment('项目名称'),
            'license' => $this->string(100)->notNull()->comment('授权协议'),
            'description' => $this->text()->notNull()->comment('描述'),
            'homepage' => $this->string(200)->notNull()->comment('项目主页'),
            'docUrl' => $this->string(200)->notNull()->comment('文档地址'),
            'viewCount' => $this->integer()->notNull()->defaultValue(0)->comment('浏览量'),
            'deleted' => 'enum("Y", "N") not null default "N" comment "删除标识"',
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "项目表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
