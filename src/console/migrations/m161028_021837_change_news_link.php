<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161028_021837_change_news_link extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%news}}', 'link', $this->string(200)->comment('链接地址'));
    }

    public function down()
    {
        
    }

}
