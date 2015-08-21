<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\DateHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */


$this->title = '成交笔数';
//\frontend\assets\AppIndexAsset::register($this);
?>
<div class="row-fluid">
    <script src="http://admin.dcxt.com/js/echarts-2.2.2/build/dist/echarts.js"></script>
    <div class="span10">
        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
            </div>
            <?php
                if(!empty($data)) :
            ?>
            <h3>今天: <?= $data[1]['data'] ?></h3>

            <h3>昨天: <?= $data[2]['data'] ?></h3>

            <h3>近30天: <?= $data[4]['data'] ?></h3>

            <h3>历史数据（2015.5.1~今日）： <?= $data[5]['data'] ?></h3>

            <div class="separate-tit">
                            <h3>今天、昨天数据统计</h3>
                            <div id="main-1" style="height:400px"></div>
                            <h3>最近30天数据统计</h3>
                            <div id="main-2" style="height:400px"></div>
                        <script type="text/javascript" language="javascript">
                            // 路径配置
                            require.config({
                                paths: {
                                    echarts: 'http://admin.dcxt.com/js/echarts-2.2.2/build/dist'
                                }
                            });

                            // 使用
                            require(
                                [
                                    'echarts',
                                    'echarts/chart/line' // 使用柱状图就加载bar模块，按需加载
                                ],
                                tubiao
                            );

                            function tubiao(ec) {
                                day(ec);
                                days(ec);
                            }
                                function day(ec) {
                                    // 基于准备好的dom，初始化echarts图表
                                    var myChart1 = ec.init(document.getElementById('main-1'));

                                    var option1 = {
                                        tooltip: {
                                            show: true
                                        },
                                        legend: {
                                            data:['今天','昨天']
                                        },
                                        xAxis : [
                                            {
                                                type : 'category',
                                                data : [<?php
                             for($i = 0;$i<24; $i ++){
                                if ($i < 10) {
                                    echo '"0' . $i . ':00",';
                                } else {
                                    echo '"' . $i . ':00",';
                                }
                             }
                             ?>]
                                            }
                                        ],
                                        yAxis : [
                                            {
                                                type : 'value'
                                            }
                                        ],
                                        series : [
                                            {
                                                "name":"今天",
                                                "type":"line",
                                                "data":[<?php
                              for($i = 0; $i<24; $i ++){
                               echo $data[1]['eachData'][$i] . ',';
                              }?>]
                                            },
                                            {
                                                "name":"昨天",
                                                "type":"line",
                                                "data":[<?php
                              for($i = 0; $i<24; $i ++){
                               echo $data[2]['eachData'][$i] . ',';
                              }?>]
                                            }
                                        ]
                                    };
                                    // 为echarts对象加载数据
                                    myChart1.setOption(option1);
                                }

                            function days(ec) {
                                // 基于准备好的dom，初始化echarts图表
                                var myChart2 = ec.init(document.getElementById('main-2'));

                                var option2 = {
                                    tooltip: {
                                        show: true
                                    },
                                    legend: {
                                        data:[]
                                    },
                                    xAxis : [
                                        {
                                            type : 'category',
                                            data : [<?php
                             for($i = 0;$i<30; $i ++){

                                    echo '"' . $data[4]['view'][$i] . '",';

                             }
                             ?>]
                                        }
                                    ],
                                    yAxis : [
                                        {
                                            type : 'value'
                                        }
                                    ],
                                    series : [
                                        {
                                            "type":"line",
                                            "data":[<?php
                              for($i = 0; $i<30; $i ++){
                               echo $data[4]['eachData'][$i] . ',';
                              }?>]
                                        }
                                    ]
                                };
                                // 为echarts对象加载数据
                                myChart2.setOption(option2);
                            }
                        </script>
            </div>
            <?php
                endif;
            ?>
        </div>
    </div>
</div>