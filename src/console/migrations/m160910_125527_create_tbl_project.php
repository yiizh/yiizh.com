<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m160910_125527_create_tbl_project extends Migration
{
    public $tableName = '{{%project}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'githubUrl' => $this->string(200)->notNull()->comment('GitHub URL'),
            'name' => $this->string(100)->comment('项目名'),
            'description' => $this->string(500)->comment('项目简介'),
            'readme' => $this->text()->comment('ReadMe'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "项目表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
