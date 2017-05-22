<?php
namespace frontend\models;
use yii\base\Model;
use common\models\Customer;
use backend\models\PaymentMethod;
use backend\models\ShippingAddress;
use backend\models\PhoneNumber;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $firstName;
    public $middleName;
    public $fathersLastName;
    public $mothersLastName;
    public $dateOfBirth;

    public $cardLastDigits;
    public $expDate;
    public $cardType;
    public $nameOnCard;
    public $billingAddress;
    public $billingState;
    public $billingZipcode;

    public $streetName;
    public $aptNumber;
    public $zipcode;
    public $state;

    public $number;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['firstName', 'fathersLastName', 'mothersLastName', 'dateOfBirth'], 'required'],
            [['firstName', 'middleName', 'fathersLastName', 'mothersLastName'], 'string', 'max' => 18],
            [['dateOfBirth'], 'string'],

            [['cardLastDigits', 'expDate', 'cardType', 'nameOnCard', 'billingAddress', 'billingState', 'billingZipcode'], 'required'],
            [['cardLastDigits'], 'integer', 'min' => 4],
            [['expDate', 'billingZipcode'], 'string', 'max' => 5],
            [['billingState'], 'string', 'max' => 2],
            [['cardType', 'nameOnCard', 'billingAddress'], 'string', 'max' => 32],

            [['streetName', 'aptNumber', 'zipcode', 'state'], 'required'],
            [['streetName'], 'string', 'max' => 32],
            [['aptNumber'], 'integer'],
            [['state', 'zipcode'], 'string'],

            [['number'], 'string', 'min' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number' => 'Phone Number',
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
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->first_name = $this->firstName;
        $user->middle_name = $this->middleName;
        $user->fathers_last_name = $this->fathersLastName;
        $user->mothers_last_name = $this->mothersLastName;
        $user->date_of_birth = $this->dateOfBirth;
        $user->generateAuthKey();
        $user->calculateAge($this->dateOfBirth);

        if ($user->save()) {
            $payment = new PaymentMethod();
            $payment->customer_id = $user->id;
            $payment->card_last_digits = $this->cardLastDigits;
            $payment->exp_date = $this->expDate;
            $payment->card_type = $this->cardType;
            $payment->name = $this->nameOnCard;
            $payment->address = $this->billingAddress;
            $payment->state = $this->billingState;
            $payment->zipcode = $this->billingZipcode;
            $payment->save(false);

            $shipping = new ShippingAddress();
            $shipping->customer_id = $user->id;
            $shipping->street_name = $this->streetName;
            $shipping->apt_number = $this->aptNumber;
            $shipping->zipcode = $this->zipcode;
            $shipping->state = $this->state;
            $shipping->save(false);

            $phone = new PhoneNumber();
            $phone->customer_id = $user->id;
            $phone->number = $this->number;
            $phone->save(false);

            return $user;
        }

        return null;
    }
}
