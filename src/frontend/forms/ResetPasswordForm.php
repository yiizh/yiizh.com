<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\forms;


use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;
    /**
     * @var User
     */
    private $_user;

    /**
     * 使用重置密码令牌创建模型
     *
     * @param  string $token
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('密码重置令牌不能为空.');
        }
        $this->_user = User::findOneByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('错误的密码重置令牌.');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '新的密码'
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save();
    }
}