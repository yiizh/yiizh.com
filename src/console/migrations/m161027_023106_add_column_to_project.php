<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161027_023106_add_column_to_project extends Migration
{
    public function up()
    {
        $this->addColumn('{{%project}}', 'summary', $this->text()->comment('摘要')->after('license'));
    }

    public function down()
    {
        $this->dropColumn('{{%project}}', 'summary');
    }

}
