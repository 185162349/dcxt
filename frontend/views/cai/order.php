<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="site-index">

    <div class="body-content">



        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($address, 'mobile') ?>
                <?= $form->field($address, 'louhao')?>
                <?= $form->field($address, 'room') ?>
                <!--                <div style="color:#999;margin:1em 0">-->
                <!--                    忘记密码？ --><?//= Html::a('找回密码', ['site/request-password-reset']) ?><!--.-->
                <!--                </div>-->
                <div class="form-group">
                    <?= Html::submitButton('提交订单', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>