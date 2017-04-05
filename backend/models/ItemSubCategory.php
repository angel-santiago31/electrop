<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "item_sub_category".
 *
 * @property integer $id
 * @property string $sub_category_name
 *
 * @property Item[] $items
 */
class ItemSubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_category_name'], 'required'],
            [['sub_category_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_category_name' => 'Sub Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['item_sub_category_id' => 'id']);
    }
}
