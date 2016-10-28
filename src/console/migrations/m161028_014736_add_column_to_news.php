<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use console\components\Migration;

class m161028_014736_add_column_to_news extends Migration
{
    public function up()
    {
        $this->addColumn('{{%news}}', 'type', $this->smallInteger()->notNull()->defaultValue(News::TYPE_DEFAULT)->comment('分类')->after('status'));
        $this->addColumn('{{%news}}', 'projectId', $this->integer()->comment('相关项目 ID')->after('type'));
        $this->renameColumn('{{%news}}', 'summary', 'content');
        $this->alterColumn('{{%news}}', 'content', $this->text()->comment('内容'));

        $this->createIndex('idx-type', '{{%news}}', 'type');

        $this->execute('update {{%news}} set type = :type', [':type' => News::TYPE_HEADLINE]);
    }

    public function down()
    {
        $this->dropColumn('{{%news}}', 'type');
        $this->dropColumn('{{%news}}', 'projectId');
        $this->renameColumn('{{%news}}', 'content', 'summary');
    }

}
