<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\QueueMail;
use console\components\Migration;

class m161104_053955_create_tbl_queue_mail extends Migration
{
    public $tableName = '{{%queue_mail}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'fromName' => $this->string(200)->notNull()->comment('发件人名称'),
            'fromMail' => $this->string(200)->notNull()->comment('发件人邮箱'),
            'to' => $this->string(200)->notNull()->comment('收件人邮箱'),
            'mailContentId' => $this->integer()->notNull()->comment('邮件内容 ID'),
            'status' => 'enum("' . QueueMail::STATUS_PENDING . '","' . QueueMail::STATUS_SEND . '") not null default "' . QueueMail::STATUS_PENDING . '" comment "状态"',
            'sendDatetime' => $this->dateTime()->comment('发送时间'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "邮件队列表"');

    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
