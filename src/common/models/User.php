<?php

namespace common\models;

use common\models\base\BaseUser;
use common\models\query\UserQuery;
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\log\Logger;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 */
class User extends BaseUser implements IdentityInterface
{
    const STATUS_ACTIVE = 100;
    const STATUS_DELETED = 0;

    const SCENARIO_PROFILE = 'profile';
    const SCENARIO_CHANGE_PASSWORD = 'changePassword';

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @return string|null
     */
    public function getStatusLabel()
    {
        $statuses = self::getStatusItems();
        return ArrayHelper::getValue($statuses, $this->status);
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_DELETED => '删除',
            self::STATUS_ACTIVE => '激活',
        ];
    }

    /**
     * @param string $email
     * @return static
     */
    public static function findOneByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * 验证密码
     *
     * @param string $password
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * 生成加密密码并将它填充到模型
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * 生成记住我的授权秘钥
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * 生成新密码的重置秘钥
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findOneByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        return $timestamp + $expire >= time();
    }


    /**
     * 移除密码重置令牌
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_PROFILE] = ['name', 'avatar'];
        $scenarios[self::SCENARIO_CHANGE_PASSWORD] = ['passwordHash', 'authKey'];

        return $scenarios;
    }

    /**
     * @param string $authclient
     * @return bool
     */
    public function hasBind($authclient)
    {
        return Auth::find()
            ->andWhere(['source' => $authclient, 'userId' => $this->id])
            ->exists();
    }

    /**
     * 取消绑定第三方帐号
     *
     * @param string $authclient
     * @return bool
     */
    public function unbind($authclient)
    {
        $tr = self::getDb()->beginTransaction();

        try {
            Auth::deleteAll(['source' => $authclient, 'userId' => $this->id]);
            if ($this->hasAttribute($authclient)) {
                $this->$authclient = null;
                if (!$this->save()) {
                    $tr->rollBack();
                    return false;
                }
            }
            $tr->commit();
            return true;
        } catch (\Exception $e) {
            Yii::getLogger()->log($e->getMessage(), Logger::LEVEL_ERROR);
            $tr->rollBack();
            return false;
        }
    }

    /**
     * 头像地址
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        if ($this->avatar == null) {
            return Url::to('@web/static/images/default-avatar.jpg');
        } else {
            return Url::to('@web' . $this->avatar);
        }
    }
}