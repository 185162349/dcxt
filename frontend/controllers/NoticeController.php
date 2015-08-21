<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-8
 * Time: 下午3:29
 */

namespace frontend\controllers;


use common\models\Notice;
use yii\base\Controller;
use yii\filters\VerbFilter;

class NoticeController extends Controller{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {

        return parent::beforeAction($action);
    }

    public function actionView($id = 0)
    {
        $id = $_GET['id'];
        $model = Notice::findOne(['id' => $id]);
        return $this->render('view',[
            'model' => $model,
        ]);
    }

} 