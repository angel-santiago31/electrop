<?php

namespace backend\models;

use Yii;
use common\models\Customer;

/**
 * This is the model class for table "phone_number".
 *
 * @property integer $customer_id
 * @property integer $number
 *
 * @property Customer $customer
 */
class PhoneNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'number'], 'required'],
            [['customer_id'], 'integer'],
            [['number'], 'string'],
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
            'number' => 'Phone Number',
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
