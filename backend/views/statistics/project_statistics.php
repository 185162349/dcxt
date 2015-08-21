<?php
use yii\helpers\Html;
$this->title = '项目成交统计';
?>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="span2">
            <?= $this->render('../_list') ?>
        </div>
    </div>


    <div class="span10">
        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <!-- panel row start -->
                    <?php echo $this->render('_search_project', array('model' => $model)); ?>
                </div>
            </div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        项目名称
                    </td>
                    <td>
                        项目开始时间
                    </td>
                    <td>
                        项目结束时间
                    </td>
                    <td>
                        项目状态
                    </td>
                    <td>
                        支持人数
                    </td>
                    <td>
                        收入
                    </td>
                    <td>
                        退款
                    </td>
                </tr>
                <?php
                foreach($data as $arr) :
                    ?>
                    <tr>
                        <td><?=$arr['id']?></td>
                        <td><?=$arr['title']?></td>
                        <td><?=$arr['startTime']?></td>
                        <td><?=$arr['endTime']?></td>
                        <td><?=$arr['status']?></td>
                        <td><?=$arr['support_num']?></td>
                        <td><?=$arr['total_money']?></td>

                        <td><?=$arr['total_refund']?></td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>