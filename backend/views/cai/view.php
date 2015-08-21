<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CaiPin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cai Pins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cai-pin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗？',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('继续添加', ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'money',
            'content:ntext',

//            'status',
        ],

    ]) ?>
    <img src="http://www.dcxt.com/image/<?php echo $model['img'];?>" alt="upload image" />

</div>
