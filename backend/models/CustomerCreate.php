<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Customer;

/**
 *
 */
class CustomerCreate extends Model
{
    public $email;
    public $password_hash;

    /**
     * @inheritdoc
     */
    public function rules()
    {
            return [
                [['password_hash'], 'required', 'message' => 'Password cannot be blank.'],
                [['email'], 'trim'],
                ['email', 'email'],
                [['email'], 'required', 'message' => 'Email cannot be blank.'],
                ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This email address has already been taken.'],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password_hash' => 'Password'
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function customerCreate()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new Customer();
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->save(false);
        
        return true;
    }
}