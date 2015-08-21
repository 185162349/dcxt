<?php

use yii\helpers\Html;

$this->title = '成交用户';
?>

<div class="span2">
    <?= $this->render('../_list', ['tag' => 'make_user']) ?>
</div>

<div class="span10">
    <div class="col-xs-10">
        <h1><?= Html::encode($this->title) ?></h1>

        <h3>今天: <?= $data[1]['data'] ?></h3>

        <h3>昨天: <?= $data[2]['data'] ?></h3>

        <h3>近7天: <?= $data[3]['data'] ?></h3>

        <h3>近30天: <?= $data[4]['data'] ?></h3>

        <h3>历史数据（10.1~今日）： <?= $data[5]['data'] ?></h3>

        <div>
            <div class="separate-tit">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="tab-count active" data-tag="tab-count-1">
                        <a><h1>今天</h1></a>
                    </li>
                    <li role="presentation" class="tab-count" data-tag="tab-count-2">
                        <a><h1>昨天</h1></a>
                    </li>
                    <li role="presentation" class="tab-count" data-tag="tab-count-3">
                        <a><h1>最近7天</h1></a>
                    </li>
                    <li role="presentation" class="tab-count" data-tag="tab-count-4">
                        <a><h1>最近30天</h1></a>
                    </li>
                </ul>
                <div class="tab-count-1">
                    <?php for ($mark = 1; $mark < 2; $mark++) : ?>
                        <!--                        <h1>今天</h1>-->
                        <table border="1" class="table table-hover">
                            <tr>
                                <?php for ($i = 0; $i < 24; $i++) : ?>
                                    <td><?php if ($i < 10) {
                                            echo '0' . $i . ':00';
                                        } else {
                                            echo $i . ':00';
                                        } ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <?php for ($i = 0; $i < 24; $i++) : ?>
                                    <td><?= $data[$mark]['eachData'][$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                        </table>
                    <?php endfor; ?>
                </div>
                <div class="tab-count-2" style="display: none;">
                    <?php for ($mark = 2; $mark < 3; $mark++) : ?>
                        <!--                        <h1>昨天</h1>-->
                        <table border="1" class="table table-hover">
                            <tr>
                                <?php for ($i = 0; $i < 24; $i++) : ?>
                                    <td><?php if ($i < 10) {
                                            echo '0' . $i . ':00';
                                        } else {
                                            echo $i . ':00';
                                        } ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <?php for ($i = 0; $i < 24; $i++) : ?>
                                    <td><?= $data[$mark]['eachData'][$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                        </table>
                    <?php endfor; ?>
                </div>
                <?php for ($mark = 3; $mark < 5; $mark++) : ?>
                    <?php if ($mark == 3) : ?>
                        <div class="tab-count-3" style="display: none;">
                            <!--                            <h1>最近7天</h1>-->
                            <table border="1" class="table table-hover">
                                <tr>
                                    <?php for ($i = 0; $i < 7; $i++) : ?>
                                        <td><?= $data[$mark]['view'][$i] ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for ($i = 0; $i < 7; $i++) : ?>
                                        <td><?= $data[$mark]['eachData'][$i] ?></td>
                                    <?php endfor; ?>
                                </tr>
                            </table>
                        </div>
                    <?php elseif ($mark == 4) : ?>
                        <div class="tab-count-4" style="display: none;">
                            <!--                            <h1>最近30天</h1>-->
                            <table border="1" class="table table-hover">
                                <tr>
                                    <?php for ($i = 0; $i < 30; $i++) : ?>
                                        <td><?= $data[$mark]['view'][$i] ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for ($i = 0; $i < 30; $i++) : ?>
                                        <td><?= $data[$mark]['eachData'][$i] ?></td>
                                    <?php endfor; ?>
                                </tr>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>


<script>
    $('.tab-count').click(function () {
        var tag = $(this).data('tag');
        tag = '.' + tag;
        $('.tab-count').removeClass('active');
        $(this).addClass('active');
        for (var i = 1; i <= 4; ++i) {
            var this_tag = '.tab-count-' + i;
            if (this_tag == tag) {
                $(this_tag).css({"display": "block"});
                continue;
            }
            $(this_tag).css({"display": "none"});
        }
    });
</script>