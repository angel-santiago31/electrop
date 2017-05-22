<?php

namespace backend\models;

use Yii;
use common\models\Customer;

/**
 * This is the model class for table "payment_method".
 *
 * @property integer $customer_id
 * @property integer $card_last_digits
 * @property integer $exp_date
 * @property string $card_type
 *
 * @property Customer $customer
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'card_last_digits', 'exp_date', 'card_type', 'zipcode','name','address', 'state'], 'required'],
            [['customer_id', 'active'], 'integer'],
            [['exp_date', 'card_last_digits', 'zipcode'], 'string'],
            [['card_type', 'name','address'], 'string', 'max' => 32],
            [['state'], 'string', 'max' => 2],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'card_last_digits' => 'Card Last Digits',
            'exp_date' => 'Expiration Date',
            'card_type' => 'Card Type',
            'name' => 'Name on Card',
            'address' => 'Address',
            'state' => 'State',
            'zipcode' => 'Zipcode',
            'active' => 'Active',

        ];
    }

    /**
     * @return primary key for the table (hace que corra aún cuando en la tabla no tenemos un PK)
     */
    public static function primaryKey()
    {
        return ['customer_id'];
    }
    /**
     * @return counting of the amount of cards the customer haves 
     */
     public function getQuantity()
    {
        return $this->find()->all()->count();
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
