<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeedBack */

$this->title = 'Update Feed Back: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Feed Backs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feed-back-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
