<?php
use yii\helpers\Html;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
            $form = \yii\bootstrap\ActiveForm::begin([
                'id' => 'create',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'options' => ['class' => 'form-field'],
                    'labelOptions' => ['class' => ''],
                ],
            ]);
            ?>
            <table class="table">
                <tr><th>留言内容</th><td><?= Html::activeTextarea($model,'content')?></td></tr>
                <tr><td><?php
                        echo \yii\helpers\Html::tag('span', Html::submitButton('提交',[
                            'class' => 'btn btn-primary col-md-offset-10',
                            'id'=>'preview',
                        ]));
                        ?></td>
                </tr>
            </table>
            <?php
            $form->end();
            ?>
        </div>

    </div>
</div>
