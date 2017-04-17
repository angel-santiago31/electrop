<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $order_number
 * @property integer $order_date
 * @property integer $amount_stickers
 * @property string $total_price
 * @property integer $order_status
 * @property integer $customer_id
 * @property string $shipper_company_name
 * @property integer $tracking_number
 *
 * @property Contains[] $contains
 * @property Item[] $items
 * @property Customer $customer
 * @property Shipper $shipperCompanyName
 */
class Order extends \yii\db\ActiveRecord
{

    public $total_sum;
    public $amount_sum;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount_stickers', 'order_status', 'customer_id', 'tracking_number'], 'integer'],
            [['order_date'], 'date'],
            [['amount_stickers'], 'required'],
            [['total_price'], 'number'],
            [['shipper_company_name'], 'string', 'max' => 18],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['shipper_company_name'], 'exist', 'skipOnError' => true, 'targetClass' => Shipper::className(), 'targetAttribute' => ['shipper_company_name' => 'shipper_name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_number' => 'Order Number',
            'order_date' => 'Order Date',
            'amount_stickers' => 'Amount Stickers',
            'total_price' => 'Total Price',
            'order_status' => 'Order Status',
            'customer_id' => 'Customer ID',
            'shipper_company_name' => 'Shipper Company Name',
            'tracking_number' => 'Tracking Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContains()
    {
        return $this->hasMany(Contains::className(), ['order_number' => 'order_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['item_id' => 'item_id'])->viaTable('contains', ['order_number' => 'order_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipperCompanyName()
    {
        return $this->hasOne(Shipper::className(), ['shipper_name' => 'shipper_company_name']);
    }
}
