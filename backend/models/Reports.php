<?php

namespace backend\models;

use Yii;
use backend\models\ItemCategory;
use backend\models\Item;

/**
 * This is the model class for table "reports".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property integer $from_date
 * @property integer $to_date
 * @property string $refers_to
 * @property string $item_selected
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'type', 'from_date', 'to_date', 'refers_to'], 'required'],
            [['description'], 'string'],
            [['from_date', 'to_date'], 'integer'],
            [['title'], 'string', 'max' => 250],
            [['type'], 'string', 'max' => 11],
            [['refers_to'], 'string', 'max' => 58],
            [['item_selected'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'refers_to' => 'Refers To',
            'item_selected' => 'Item Selected',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {


            return true;
        } else {
            return false;
        }
    }

    /**
    *   Find a Category name for a groupBy.
    **/
    public function findCategoryId($id)
    {
        $sql = 'SELECT category_name
                FROM `item_category`
                WHERE id = ' . $id;
        $result = ItemCategory::findBySql($sql)->all();
        return $result[0]->category_name;
    }

    /**
    *   Find the item name for a specific Item being grouped by.
    **/
    public function findItemName($id)
    {
        $sql = 'SELECT name
                FROM `item`
                WHERE item_id = ' . $id;
        $result = Item::findBySql($sql)->all();
        return $result[0]->name;
    }
}
