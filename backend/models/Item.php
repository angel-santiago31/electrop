<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use \yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "item".
 *
 * @property integer $item_id
 * @property string $name
 * @property string $picture
 * @property integer $quantity_remaining
 * @property string $size
 * @property string $gross_price
 * @property string $production_cost
 * @property string $description
 * @property integer $item_category_id
 * @property integer $item_sub_category_id
 * @property integer $active
 *
 * @property Contains[] $contains
 * @property Order[] $orderNumbers
 * @property ItemCategory $itemCategory
 * @property ItemSubCategory $itemSubCategory
 */
class Item extends ActiveRecord implements \yz\shoppingcart\CartPositionInterface
{
    use \yz\shoppingcart\CartPositionTrait;

    public const ACTIVE = 1;
    public const DELETED = 0;
    public $file;
    public $quota;

    public const DECALS = 1;
    public const WALL = 2;
    public const FLOOR = 3;

    public const JOKES = 1;
    public const BRANDS = 2;
    public const ANIMALS = 3;
    public const RANDOM = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'picture', 'quantity_remaining', 'size', 'gross_price', 'production_cost', 'description', 'item_category_id', 'item_sub_category_id'], 'required'],
            [['item_id', 'quantity_remaining', 'item_category_id', 'item_sub_category_id', 'active'], 'integer'],
            [['gross_price', 'production_cost'], 'number'],
            [['name', 'size'], 'string', 'max' => 32],
            [['picture', 'description'], 'string', 'max' => 256],
            [['item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['item_category_id' => 'id']],
            [['item_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemSubCategory::className(), 'targetAttribute' => ['item_sub_category_id' => 'id']],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['quantity'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'name' => 'Name',
            'picture' => 'Picture',
            'quantity_remaining' => 'Quantity Remaining',
            'size' => 'Size',
            'gross_price' => 'Gross Price',
            'production_cost' => 'Production Cost',
            'description' => 'Description',
            'item_category_id' => 'Item Category ID',
            'item_sub_category_id' => 'Item Sub Category ID',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContains()
    {
        return $this->hasMany(Contains::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNumbers()
    {
        return $this->hasMany(Order::className(), ['order_number' => 'order_number'])->viaTable('contains', ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'item_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSubCategory()
    {
        return $this->hasOne(ItemSubCategory::className(), ['id' => 'item_sub_category_id']);
    }

    /**
     * @return
     */
     public function getPrice()
     {
         return $this->gross_price;
     }
     /**
     * @return \yii\db\ActiveQuery
     */
     public function getId()
     {
         return $this->item_id;
     }

    public function getIsActive()
    {
      return ($this->active === self::DELETED)? 'btn btn-success' : 'btn btn-success disabled';
    }

    public function getIsInactive()
    {
      return ($this->active === self::ACTIVE)? 'btn btn-danger' : 'btn btn-danger disabled';
    }
}
