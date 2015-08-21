<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dizhi".
 *
 * @property string $id
 * @property integer $userid
 * @property string $mobile
 * @property integer $louhao
 * @property integer $room
 * @property integer $status
 */
class DiZhi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dizhi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid','status'], 'integer'],
            [['mobile','louhao','room'], 'string', 'max' => 100],
            [['mobile'], 'required','message' => '电话号码不能为空'],
            [['louhao'], 'required','message' => '楼号不能为空'],
            [['room'], 'required','message' => '房间号不能为空'],
            ['mobile','match','pattern' => '/^1[0-9]{10}$/','message' => '手机号不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'mobile' => '电话号码',
            'louhao' => '楼号',
            'room' => '房间号',
            'status' => 'Status',
        ];
    }
}
