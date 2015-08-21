<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CaiPin */

$this->title = '修改菜品: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cai Pins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cai-pin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
