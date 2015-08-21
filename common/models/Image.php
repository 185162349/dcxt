<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property string $id
 * @property string $image_username
 * @property string $image_filename
 * @property string $image_date
 * @property integer $status
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_date', 'status'], 'integer'],
            [['image_username','image_filename'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_username' => 'Image Username',
            'image_filename' => 'image_filename',
            'image_date' => 'Image Date',
            'status' => 'Status',
        ];
    }
}
