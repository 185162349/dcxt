<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-13
 * Time: 下午4:28
 */

namespace frontend\controllers;


use common\helpers\AppHelper;
use common\models\CaiPin;
use common\models\DiZhi;
use common\models\LinShiOrder;
use common\models\Order;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CaiController extends Controller{

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


    //临时订单
    public function actionView($id = 0)
    {
        $userid = \Yii::$app->getUser()->id;
        $model = CaiPin::findOne(['id' => $id]);
        $lsOrderModel = new LinShiOrder();
        $orderModel = Order::find()
            ->where(['userid' => $userid])
            ->all();
        if($lsOrderModel->load(\Yii::$app->request->post()))
        {
            $lsOrderModel->total_money = $lsOrderModel['cai_money'] * $lsOrderModel['num'];
            $lsOrderModel->userid = $userid;
            if($lsOrderModel->save(false)) {
                $model->num = $model['num'] + 1;
                $model->save(false);
                return $this->redirect(['site/index']);
            }
        } else {
            $lsOrderModel->cai_name= $model['name'];
            $lsOrderModel->cai_money = $model['money'];
            return $this->render('view',[
                'id' => $id,
               'model' => $lsOrderModel,
                'cai' => $model,
            ]);
        }
    }


    //订餐车
    public function actionOrderCar()
    {
        $userid = \Yii::$app->getUser()->id;
        $models = LinShiOrder::find()
            ->where(['userid' => $userid])
            ->andWhere(['status' => 0])
            ->all();
        return $this->render('order_car',[
            'models' => $models,
        ]);
    }


    public function actionAddress()
    {
        $userid = \Yii::$app->getUser()->id;
        $orderModel = new Order();
        $lsModels = LinShiOrder::find()
            ->where([
                'userid' => $userid,
                'status' => 0
            ])
            ->all();
        $address = new DiZhi();
        $sum = 0;
        foreach($lsModels as $lsModel){
            $sum += $lsModel['total_money'];
        }
        if($address->load(\Yii::$app->request->post())){
            $orderModel->userid = $userid;
            $orderModel->money = $sum;
            if($orderModel->save(false)) {
                $address->userid = $userid;
                $address->order_id = $orderModel['id'];
                $address->save(false);
                foreach($lsModels as $lsModel){
                    $lsModel->status = 1;
                    $lsModel->order_id = $orderModel['id'];
                    $lsModel->save(false);
                }
            }
            return $this->redirect(['site/index']);
        }else{
            return $this->render('order',[
                'address' => $address,
                'sum' => $sum,
            ]);
        }
    }

    public function actionOrder()
    {
        $userid = \Yii::$app->getUser()->id;
        $models = Order::find()
            ->where(['userid' => $userid])
            ->orderBy('created_at desc')
            ->all();
        return $this->render('my_order',[
            'models' => $models,
        ]);
    }

    public function actionDeleteOrder()
    {
        $userid = \Yii::$app->getUser()->id;
        $models = LinShiOrder::find()
            ->where(['userid' => $userid])
            ->andWhere(['status' => 0])
            ->all();
        foreach($models as $model)
        {
            $model->status = -1;
            $model->save(false);
        }
        return $this->redirect(['site/index']);
    }

    public function actionViews()
    {
        $orderid = AppHelper::get('id');
        $LinShiModel = LinShiOrder::find()
            ->where(['order_id' => $orderid])
            ->all();
        $DiZhi = DiZhi::findOne(['order_id' => $orderid]);
        return $this->render('views', [
            'model' => $this->findModel($orderid),
            'LinShiModels' => $LinShiModel,
            'DiZhi' => $DiZhi,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
} 