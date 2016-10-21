<?php


use console\components\Migration;

class m160912_051552_create_tbl_activity extends Migration
{
    public $tableName = '{{%activity}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'userId' => $this->integer()->notNull()->comment('用户 ID'),
            'objectType' => $this->integer()->notNull()->comment('对象类型'),
            'objectId' => $this->integer()->notNull()->comment('对象 ID'),
            'content' => $this->string(200)->comment('内容'),
            'createdAt' => $this->integer()->comment('创建时间'),
        ], $this->tableOptions . ' comment "动态表"');

        $this->addForeignKey('fk-activity_userId-user_id', $this->tableName, 'userId', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx-activity_objectType', $this->tableName, 'objectType');
        $this->createIndex('idx-activity_objectId', $this->tableName, 'objectId');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
