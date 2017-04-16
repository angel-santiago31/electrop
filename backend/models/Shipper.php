<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shipper".
 *
 * @property string $shipper_name
 * @property integer $company_phone_num
 * @property string $company_address
 *
 * @property Order[] $orders
 */
class Shipper extends \yii\db\ActiveRecord
{
    const UPS = "UPS";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipper';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipper_name', 'company_phone_num', 'company_address'], 'required'],
            [['company_phone_num'], 'integer'],
            [['company_address'], 'string'],
            [['shipper_name'], 'string', 'max' => 18],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shipper_name' => 'Shipper Name',
            'company_phone_num' => 'Company Phone Num',
            'company_address' => 'Company Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['shipper_company_name' => 'shipper_name']);
    }
}
