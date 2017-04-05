<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contains".
 *
 * @property integer $order_number
 * @property integer $item_id
 * @property string $price_sold
 * @property integer $quantity_in_order
 *
 * @property Order $orderNumber
 * @property Item $item
 */
class Contains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contains';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'item_id', 'price_sold', 'quantity_in_order'], 'required'],
            [['order_number', 'item_id', 'quantity_in_order'], 'integer'],
            [['price_sold'], 'number'],
            [['order_number'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_number' => 'order_number']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_number' => 'Order Number',
            'item_id' => 'Item ID',
            'price_sold' => 'Price Sold',
            'quantity_in_order' => 'Quantity In Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNumber()
    {
        return $this->hasOne(Order::className(), ['order_number' => 'order_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
}
