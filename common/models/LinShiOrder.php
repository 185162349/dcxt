<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ls_order".
 *
 * @property string $id
 * @property integer $userid
 * @property string $cai_name
 * @property double $cai_money
 * @property integer $num
 * @property double $total_money
 * @property integer $order_id
 * @property string $created_at
 * @property integer $status
 */
class LinShiOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ls_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'num', 'order_id', 'created_at', 'status'], 'integer'],
            [['cai_name', 'cai_money'], 'required'],
            [['num'], 'required','message' => '数量不能为空'],
            [['cai_money', 'total_money'], 'number'],
            [['cai_name'], 'string', 'max' => 100]
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
            'cai_name' => '菜品名称',
            'cai_money' => '单价',
            'num' => '预定数量',
            'total_money' => 'Total Money',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
            'status' => 'Status',
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
}
