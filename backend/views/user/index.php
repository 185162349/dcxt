<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
            'admin' =>[
                'class' => 'yii\grid\DataColumn',
                'label' => '用户类型',
                'attribute' => 'status',
                'value' => function($model) {
                        return $model->admin == 1?'管理员':'普通用户';
                    }
            ],
//            'admin',
//            'auth_key',
//            'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                                return Html::a('删除该用户', $url, [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => '确定要删除该用户吗',
                                        'method' => 'post',
                                    ],
                                ]);
                        },
                ]
            ],
        ],
    ]); ?>

</div>
