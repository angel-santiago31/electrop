<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sticker_size".
 *
 * @property integer $id
 * @property string $size
 */
class StickerSize extends \yii\db\ActiveRecord
{
    const SMALL = 1;
    const MEDIUM = 2;
    const LARGE = 3;
    const EXTRA_LARGE = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sticker_size';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['size'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size' => 'Size',
        ];
    }
}
