<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string|null $patronymic
 * @property string $phone
 * @property string $login
 * @property string $password
 * @property int $role_id
 *
 * @property Comment[] $comments
 * @property OrderWorker[] $orderWorkers
 * @property Order[] $orders
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'phone', 'login', 'password', 'role_id'], 'required'],
            [['role_id'], 'integer'],
            [['surname', 'name', 'patronymic'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['login', 'password'], 'string', 'max' => 32],
            [['login'], 'unique'],
            [['phone'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Surname',
            'name' => 'Name',
            'patronymic' => 'Patronymic',
            'phone' => 'Phone',
            'login' => 'Login',
            'password' => 'Password',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['worker_id' => 'id']);
    }

    /**
     * Gets query for [[OrderWorkers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderWorkers()
    {
        return $this->hasMany(OrderWorker::class, ['worker_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return User::findOne(['login' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    function roleMiddleware($roles): bool
    {
        return in_array(Yii::$app->user->identity->role->code, explode('&', $roles), true);
    }
}
