<?php

/**
 * @var yii\web\View $this
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\project\ProjectOrder;
use common\models\project\Project;
?>
<div class="form-group">
    <?php $form = ActiveForm::begin([
        'action' => [''],
        'method' => 'get',
    ]); ?>
    <div class="row">

        <div class="col-xs-2">
            <?= $form->field($model, 'id')->textInput(['placeholder' => '项目编号']) ?>
        </div>
        <div class="col-xs-2">
            <?= $form->field($model, 'status')->dropDownList([
                Project::STATUS_DOING => '进行中',
                Project::STATUS_SUCC => '已成功',
                Project::STATUS_FAILED => '失败',
            ],['class' => 'form-control', 'prompt' => '']) ?>
        </div>


    </div>

    <div class="row">
        <div class="col-xs-3">
            <?=
            $form->field($model, 'startDate')->input('date', [
                'class' => 'inputDate form-control', 'placeholder' => '开始时间'
            ])?>
        </div>
        <div class="col-xs-3">
            <?=
            $form->field($model, 'endDate')->input('date', [
                'class' => 'inputDate form-control', 'placeholder' => '结束时间'
            ])?>
        </div>

        <div class="col-xs-2">
<!--            <span class="input-group-btn">-->
<!--                 <a href="#" id="export_excel" class="btn btn-info btn-sm">导出订单列表</a>-->
<!--            </span>-->
            <div class="form-group">
                <?= Html::submitButton('查询', ['class' => 'btn btn-primary', 'style' => 'margin-top: 25px;']) ?>
            </div>

        </div>
        <div class="col-xs-2">
            <button type="button" id="export_excel" class="btn btn-info" style=" margin-top: 24px;">导出查询内容</button>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="javascript">
    $('.inputDate').DatePicker({
        format: 'm/d/Y',
        date: $('.inputDate').val(),
        current: $('.inputDate').val(),
        starts: 1,
        position: 'r',
        onBeforeShow: function () {
            $('.inputDate').DatePickerSetDate($('.inputDate').val(), true);
        },
        onChange: function (formated, dates) {
            $('.inputDate').val(formated);
            if ($('.closeOnSelect input').attr('checked')) {
                $('.inputDate').DatePickerHide();
            }
        }
    });

</script>
<script type="text/javascript">
    $("#export_excel").on('click',function () {
        var startDate = document.getElementById("projectform-startdate");
        var endDate = document.getElementById("projectform-enddate");

        var id = document.getElementById("projectform-id");
//        var type = document.getElementById("projectform-type");
        var status = document.getElementById("projectform-status");
//        window.open("index.php?r=project/export-project&ProjectForm[startDate]=" + startDate.value + "&ProjectForm[endDate]="
//            + endDate.value + "&ProjectForm[id]=" + id.value + "&ProjectForm[status]=" + status.value
//            + "&ProjectForm[type]=" + type.value , "_blank");
        window.open("index.php?r=statistics/export-project-statistics&ProjectForm[startDate]=" + startDate.value + "&ProjectForm[endDate]="
            + endDate.value + "&ProjectForm[id]=" + id.value + "&ProjectForm[status]=" + status.value, "_blank");
    });
</script>

