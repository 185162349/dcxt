<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FeedBackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '留言板';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feed-back-index">

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
            'content:ntext',
            'created_at' => [
                'class' => 'yii\grid\DataColumn',
                'label' => '留言时间',
                'attribute' => 'created_at',
                'value' => function ($model) {
                        return date("Y-m-d",$model->created_at);
                    }
            ],
//            'status',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
