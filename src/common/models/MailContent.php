<?php

namespace common\models;

use common\models\base\BaseMailContent;

/**
 */
class MailContent extends BaseMailContent
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['subject', 'required'];
        $rules[] = ['body', 'required'];
        return $rules;
    }

    /**
     * @inheritdoc
     * @return \common\models\query\MailContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MailContentQuery(get_called_class());
    }
}
