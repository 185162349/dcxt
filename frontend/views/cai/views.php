<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if($model->status == 0) :?>
            <?= Html::a('受理订单', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            <?= Html::a('取消订单', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '确定要取消该订单吗？',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ;?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',

            [
                'label' => '用户名',
                'value' => $model->user->username,
            ],
            'money',
            [
                'label' => '下单时间',
                'value' => date("Y-m-d",$model->created_at),
            ],
            [
                'label' => '状态',
                'value' => $model->status == 1?'已受理':'未受理',
            ],
        ],
    ]) ?>

    <h3>地址：<?= $DiZhi['louhao'] ?>  &nbsp;&nbsp; <?= $DiZhi['room'] ?></h3>
    <h3>电话号码：<?= $DiZhi['mobile']?></h3>
    <div class="row-fluid">
        <div class="span6">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        菜品名称
                    </th>
                    <th>
                        单价
                    </th>
                    <th>
                        数量
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($LinShiModels as $LinShiModel) : ?>
                    <tr>
                        <td>
                            <?= $LinShiModel['cai_name']?>
                        </td>
                        <td>
                            <?= $LinShiModel['cai_money']?>
                        </td>
                        <td>
                            <?= $LinShiModel['num']?>
                        </td>
                    </tr>
                <?php endforeach ;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
