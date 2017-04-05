<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Customer;

/**
 * Signup form
 */
class SignupForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $firstName;
    public $middleName;
    public $fathersLastName;
    public $mothersLastName;
    public $dateOfBirth;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['username', 'trim'],
            //['username', 'required'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            //['username', 'string', 'min' => 2, 'max' => 255],

            [['firstName', 'fathersLastName', 'mothersLastName', 'dateOfBirth'], 'required'],
            [['firstName', 'fathersLastName', 'mothersLastName', 'middleName'], 'string', 'max' => 32],
            [['dateOfBirth'], 'safe'],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Customer();
        //$user->username = $this->username;
        $user->email = $this->email;
        $user->first_name = $this->firstName;
        $user->middle_name = $this->middleName;
        $user->fathers_last_name = $this->fathersLastName;
        $user->mothers_last_name = $this->mothersLastName;
        $user->date_of_birth = $this->dateOfBirth;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
