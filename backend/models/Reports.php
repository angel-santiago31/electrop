<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property string $from_date
 * @property string $to_date
 * @property string $refers_to
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
            [['description'], 'string'],
            [['type'], 'required'],
            [['type'], 'string', 'max' => 250],
            [['from_date', 'to_date'], 'date'],
            [['title'], 'string', 'max' => 250],
            [['refers_to'], 'string', 'max' => 58],
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
        ];
    }
}
