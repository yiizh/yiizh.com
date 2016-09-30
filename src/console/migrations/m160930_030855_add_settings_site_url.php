<?php


use common\models\Settings;
use console\components\Migration;

class m160930_030855_add_settings_site_url extends Migration
{
    public function up()
    {
        $this->insert('{{%settings}}',
            [
                'name' => '站点 URL',
                'description' => '站点网址',
                'code' => Settings::SITE_URL,
                'value' => '',
                'isEncoded' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::SITE_URL]);
    }

}
