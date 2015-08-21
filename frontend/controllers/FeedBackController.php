<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-5
 * Time: 上午10:34
 */

namespace frontend\controllers;


use common\models\FeedBack;
use yii\filters\VerbFilter;
use yii\web\Controller;

class FeedBackController  extends Controller{
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

    //创建留言板
    public function actionCreate()
    {
        $userid = \Yii::$app->getUser()->id;
        $model = new FeedBack();
        if($model->load(\Yii::$app->request->post())){
            $model->userid = $userid;
            if($model->save(false)){
                return $this->redirect(['view']);
            }
        } else {
            return $this->render('create',[
                'model' => $model,
            ]);
        }
    }

    //展示留言板
    public function actionView()
    {
        $userid = \Yii::$app->getUser()->id;
        $models = FeedBack::find()
            ->where(['userid' => $userid])
            ->orderBy('created_at desc')
            ->all();
        return $this->render('view',[
           'models' => $models,
        ]);
    }

} 