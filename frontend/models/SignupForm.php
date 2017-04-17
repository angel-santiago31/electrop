<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Customer;
use backend\models\PhoneNumber;
use backend\models\PaymentMethod;
use backend\models\ShippingAddress;

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
    public $phoneNumber;
    public $cardLastDigits;
    public $expDate;
    public $cardType;
    public $streetName;
    public $aptNumber;
    public $zipCode;
    public $state;

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

            ['phoneNumber', 'required'],
            ['phoneNumber', 'integer', 'min' => 10],
           
            ['cardLastDigits', 'required'],
            ['cardLastDigits', 'integer', 'max' => 4],
           
            ['cardType', 'required'],
           
            ['expDate', 'required'],

            ['streetName', 'required'],
            ['aptNumber', 'required'],
            ['zipCode', 'required'],
            ['zipCode','integer', 'min' => 6],
            ['state', 'required'],
            ['state', 'string', 'max' => 2],
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
        
        if ($user->save()) {
            $phone = new PhoneNumber();
            $phone->customer_id = $user->id;
            $phone->number = $this->phoneNumber;
            $phone->save();
            print_r($phone->errors);

            $payment = new PaymentMethod();
            $payment->customer_id = $user->id;
            $payment->card_last_digits = $this->cardLastDigits;
            $payment->exp_date = $this->expDate;
            $payment->card_type = $this->cardType;
            $payment->save();
            print_r($payment->errors);

            $shipping = new ShippingAddress();
            $shipping->customer_id = $user->id;
            $shipping->street_name = $this->streetName;
            $shipping->apt_number = $this->aptNumber;
            $shipping->zipcode = $this->zipCode;
            $shipping->state = $this->state;
            $shipping->save();
            print_r($shipping->errors);

            return $user;
            // if ($phone->save() && && ) {
            //     return $user;
            // }

            // return null;
            
        }   
    }
}
