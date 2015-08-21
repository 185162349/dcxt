<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'userid' => [
                'class' => 'yii\grid\DataColumn',
                'label' => '用户名',
                'attribute' => 'userid',
                'value' => function($model) {
                        return $model->user->username;
                    }
            ],
            'money',
            'created_at' => [
                'class' => 'yii\grid\DataColumn',
                'label' => '下单时间',
                'attribute' => 'created_at',
                'value' => function ($model) {
                        return date("Y-m-d H:i:s",$model->created_at);
                    }
            ],
            'updated_at' => [
                'class' => 'yii\grid\DataColumn',
                'label' => '受理时间',
                'attribute' => 'updated_at',
                'value' => function ($model) {
                        if(!empty($model->updated_at)) {
                            return date("Y-m-d H:i:s",$model->updated_at);
                        } else {
                            return '';
                        }
                    }
            ],
            'status' =>[
                'class' => 'yii\grid\DataColumn',
                'label' => '订单状态',
                'attribute' => 'status',
                'value' => function($model) {
                        return $model->status == 1?'已受理':'未受理';
                    }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update}{delete}{view}',
                'buttons' => [
                    'update' => function ($url, $model) {
                            if($model->status == 0){
                                return Html::a('受理', $url, [
                                    'class' => 'btn btn-info',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]);
                            }
                        },
                    'delete' => function ($url, $model) {
                            if($model->status == 0){
                                return Html::a('取消订单', $url, [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => '确定要取消该订单吗',
                                        'method' => 'post',
                                    ],
                                ]);
                            }

                        },
                    'view' => function ($url, $model) {
                                return Html::a('查看', $url, ['class' => 'btn btn-warning']);
                        },
                ]
            ],
        ],
    ]); ?>

</div>
