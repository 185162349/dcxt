<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "feedback".
 *
 * @property string $id
 * @property integer $userid
 * @property string $content
 * @property string $created_at
 * @property integer $status
 */
class FeedBack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'status'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户id',
            'content' => '内容',
            'created_at' => '创建时间',
            'status' => '状态',
        ];
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'userid']);
    }
}
