<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m160909_131803_create_tbl_user extends Migration
{
    public $tableName = '{{%user}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'email' => $this->string(200)->notNull()->comment('邮箱'),
            'name' => $this->string(50)->notNull()->comment('昵称'),
            'authKey' => $this->string(32)->notNull()->comment('授权秘钥'),
            'passwordHash' => $this->string(100)->comment('加密密钥'),
            'passwordResetToken' => $this->string(100)->comment('重置密码令牌'),
            'status' => $this->smallInteger()->notNull()->defaultValue('100')->comment('状态'),
            'avatar' => $this->string(200)->comment('头像地址'),
            'weibo' => $this->string(100)->comment('绑定的微博账号'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "用户表"');

        $this->createIndex('unq-email', $this->tableName, 'email', true);
        $this->createIndex('idx-status', $this->tableName, 'status');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
