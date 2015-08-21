<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="site-index">

    <div class="body-content">



        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'cai_name') ->textInput(['readonly' => 'readonly']) ?>
                <?= $form->field($model, 'cai_money') -> textInput(['readonly' => 'readonly'])?>
                <?= $form->field($cai, 'content') -> textarea(['readonly' => 'readonly','rows' => '7'])?>
                <?= $form->field($model, 'num') ->dropDownList(['1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5]) ?>
                <!--                <div style="color:#999;margin:1em 0">-->
                <!--                    忘记密码？ --><?//= Html::a('找回密码', ['site/request-password-reset']) ?><!--.-->
                <!--                </div>-->
                <div class="form-group">
                    <?= Html::submitButton('预定', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>