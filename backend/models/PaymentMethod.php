<?php

namespace backend\models;

use Yii;

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
            [['customer_id', 'card_last_digits', 'exp_date', 'card_type'], 'required'],
            [['customer_id', 'card_last_digits', 'exp_date'], 'integer'],
            [['card_type'], 'string', 'max' => 32],
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
            'exp_date' => 'Exp Date',
            'card_type' => 'Card Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
