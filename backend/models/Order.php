<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Customer;
use backend\models\Shipper;

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
class Order extends ActiveRecord
{

    const CANCELED = 0;
    const PENDING = 1;
    const VERIFIED = 2;
    const SHIPPED = 3;
    const DELIVERED = 4;

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
     public function behaviors()
     {
         return [
             [
                 'class' => TimestampBehavior::className(),
                 'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['order_date'],
                 ],
             ],
         ];
     }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_date', 'amount_stickers', 'order_status', 'customer_id', 'tracking_number'], 'integer'],
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

    public function isCartEmpty()
    {
        return (Yii::$app->cart->getCount() == NULL) ? 'btn btn-default disabled pull-right' : 'btn btn-default pull-right';
    }
}
