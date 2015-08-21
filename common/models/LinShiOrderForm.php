<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LinShiOrderForm extends Model
{
    public $cai_name;
    public $cai_money;
    public $num;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cai_name','cai_money'], 'required'],
            [['num'], 'required','message' => '数量不能为空'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'rememberMe' => '下次自动登录',
        ];
    }
}
