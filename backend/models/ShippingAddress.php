<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shipping_address".
 *
 * @property integer $customer_id
 * @property string $street_name
 * @property integer $apt_number
 * @property integer $zipcode
 * @property string $state
 *
 * @property Customer $customer
 */
class ShippingAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'street_name', 'apt_number', 'zipcode', 'state'], 'required'],
            [['customer_id', 'apt_number', 'zipcode'], 'integer'],
            [['street_name'], 'string', 'max' => 32],
            [['state'], 'string', 'max' => 2],
            //[['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'street_name' => 'Street Name',
            'apt_number' => 'Apt Number',
            'zipcode' => 'Zipcode',
            'state' => 'State',
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
