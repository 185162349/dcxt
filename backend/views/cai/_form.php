<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CaiPin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cai-pin-form">

    <form action="" method="post" enctype="multipart/form-data">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <tr>
        <td>添加图片</td>
        <td><input type="file" name="uploadfile"/></td>
    </tr>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
