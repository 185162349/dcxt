<?php

/**
 * @var yii\web\View $this
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\project\ProjectOrder;
?>
<div class="form-group">
    <?php $form = ActiveForm::begin([
        'action' => [''],
        'method' => 'get',
    ]); ?>

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
        var startDate = document.getElementById("projectorderform-startdate");
        var endDate = document.getElementById("projectorderform-enddate");

        var id = document.getElementById("projectorderform-project_id");
//        var type = document.getElementById("projectform-type");
        var status = document.getElementById("projectorderform-status");
//        window.open("index.php?r=project/export-project&ProjectForm[startDate]=" + startDate.value + "&ProjectForm[endDate]="
//            + endDate.value + "&ProjectForm[id]=" + id.value + "&ProjectForm[status]=" + status.value
//            + "&ProjectForm[type]=" + type.value , "_blank");
        window.open("index.php?r=statistics/export-orders&ProjectOrderForm[startDate]=" + startDate.value + "&ProjectOrderForm[endDate]="
            + endDate.value + "&ProjectOrderForm[id]=" + id.value + "&ProjectOrderForm[status]=" + status.value, "_blank");
    });
</script>

