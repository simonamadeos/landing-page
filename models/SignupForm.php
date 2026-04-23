<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignupForm adalah form untuk pendaftaran user baru
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Username sudah digunakan.'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Email sudah digunakan.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = 'user'; // default semua signup jadi user
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
