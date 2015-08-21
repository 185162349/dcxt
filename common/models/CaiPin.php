<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cai".
 *
 * @property string $id
 * @property string $name
 * @property double $money
 * @property double $num
 * @property string $content
 * @property string $img
 * @property integer $status
 */
class CaiPin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money'], 'number'],
            [['content'], 'string'],
            [['status','num'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜品名称',
            'money' => '单价',
            'content' => '菜品详情',
            'num' => '售出数量',
            'img' => '图片地址',
            'status' => '状态',
        ];
    }
}
