<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;

class m160911_110630_create_tbl_settings extends Migration
{
    public $tableName = '{{%settings}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'name' => $this->string(100)->notNull()->comment('名称'),
            'description' => $this->string(200)->comment('描述'),
            'code' => $this->string(200)->notNull()->comment('识别码'),
            'value' => $this->string(2000)->comment('值'),
            'isEncoded' => $this->boolean()->notNull()->defaultValue(0)->comment('是否已编码'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "设置表"');

        $this->createIndex('unq-code', $this->tableName, 'code', true);

        $this->insertDefaultValues();
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

    public function getSettiongs()
    {
        return [
            [
                'name' => '站点名',
                'description' => '站点名称',
                'code' => Settings::SITE_NAME,
                'value' => 'YiiZh',
                'isEncoded' => 0,
            ],
            [
                'name' => '站点描述',
                'description' => '站点描述',
                'code' => Settings::SITE_DESCRIPTION,
                'value' => '',
                'isEncoded' => 0,
            ],
            [
                'name' => '站点关键字',
                'description' => '站点关键字',
                'code' => Settings::SITE_KEYWORDS,
                'value' => '',
                'isEncoded' => 0,
            ],
            [
                'name' => '微博 APP Key',
                'description' => '微博 APP Key',
                'code' => Settings::WEIBO_APP_KEY,
                'value' => '',
                'isEncoded' => 0,
            ],
            [
                'name' => '微博 APP Secret',
                'description' => '微博 APP Secret',
                'code' => Settings::WEIBO_APP_SECRET,
                'value' => '',
                'isEncoded' => 0,
            ],
        ];
    }

    public function insertDefaultValues()
    {
        $settings = $this->getSettiongs();

        foreach ($settings as $setting) {
            $setting['createdAt'] = time();
            $setting['updatedAt'] = time();
            $this->insert('{{%settings}}', $setting);
        }

    }

}
