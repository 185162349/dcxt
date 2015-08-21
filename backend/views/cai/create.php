<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CaiPin */

$this->title = '创建菜品';
$this->params['breadcrumbs'][] = ['label' => 'Cai Pins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cai-pin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
