<?php
use yii\helpers\Html;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
            $form = \yii\bootstrap\ActiveForm::begin([
                'id' => 'feedback',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'options' => ['class' => 'form-field'],
                    'labelOptions' => ['class' => ''],
                ],
            ]);
            ?>
            <table class="table">
                <?php foreach($models as $model) :?>
                <tr><td><?= $model['content']?></td>
                <td><?= date("Y-m-d",$model['created_at'])?></td></tr>
                <?php endforeach ;?>
            </table>
            <?php
            $form->end();
            ?>
        </div>

    </div>
</div>
