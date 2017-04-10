<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Customer;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $email
 * @property string $password_hash
 * @property string $first_name
 * @property string $middle_name
 * @property string $fathers_last_name
 * @property string $mothers_last_name
 * @property integer $date_of_birth
 * @property integer $age
 * @property string $auth_key
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 *
 * @property Order[] $orders
 * @property PaymentMethod $paymentMethod
 * @property PhoneNumber $phoneNumber
 * @property ShippingAddress $shippingAddress
 */
class CustomerAccountForm extends Model
{

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
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password_hash', 'first_name', 'middle_name', 'fathers_last_name', 'mothers_last_name', 'date_of_birth', 'auth_key', 'created_at', 'updated_at', 'active'], 'required'],
            [['date_of_birth', 'age', 'status', 'created_at', 'updated_at', 'active'], 'integer'],
            [['email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['first_name', 'middle_name', 'fathers_last_name', 'mothers_last_name'], 'string', 'max' => 18],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumber()
    {
        return $this->hasOne(PhoneNumber::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddress()
    {
        return $this->hasOne(ShippingAddress::className(), ['customer_id' => 'id']);
    }

    
}
