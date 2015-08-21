<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-4
 * Time: 下午5:05
 */

namespace backend\controllers;

use common\classes\Chart;
use common\helpers\AppHelper;
use common\helpers\DateHelper;
use common\models\Order;
use common\models\search\OrderSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use backend\models\excel\excel_style;

class StatisticsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => [
                ],
                'rules' => [
                    [
//                        'actions' => ['logout', 'index','view','project-ext-view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];

    }

    public function beforeAction($action)
    {
        if (AppHelper::isAjax()) {
            $this->enableCsrfValidation = false;
        }
        return true;
    }


    //成交笔数
    public function actionMakeCount()
    {
        $model = new Order();
        $searchModel = new OrderSearch();
        $model->load(\Yii::$app->request->get());
            for ($markZero = 0; $markZero < 25; $markZero++) {
                $todayHour[$markZero] = strtotime(date('Y-m-d', time())) + $markZero * 3600;
                $yesterdayHour[$markZero] = strtotime(date('Y-m-d', time() - 86400)) + $markZero * 3600;
            }
            for ($markDay = 0; $markDay < 7; $markDay++) {
                $weekDay[$markDay] = strtotime(date('Y-m-d', time() - 6 * 86400 + $markDay * 86400));
                $viewWeekDay[$markDay] = date('Y-m-d', $weekDay[$markDay]);
            }
            $weekDay[7] = time();
            for ($markDay = 0; $markDay < 30; $markDay++) {
                $monthDay[$markDay] = strtotime(date('Y-m-d', time() - 29 * 86400 + $markDay * 86400));
                $viewDay[$markDay] = date('m-d', $monthDay[$markDay]);
            }
            $monthDay[30] = time();
            $date_times = [
                [
                    'start_time' => strtotime(DateHelper::date(time())),
                    'end_time' => time(),
                    'x' => 'today',
                    'each' => $todayHour,
                ],
                [
                    'start_time' => strtotime(DateHelper::date(time() - 86400)),
                    'end_time' => strtotime(DateHelper::date(time())),
                    'x' => 'yesterday',
                    'each' => $yesterdayHour,
                ],
                [
                    'start_time' => strtotime(DateHelper::date(time() - 6 * 86400)),
                    'end_time' => time(),
                    'x' => 'oneWeek',
                    'each' => $weekDay,
                    'view' => $viewWeekDay,
                ],
                [
                    'start_time' => strtotime(DateHelper::date(time() - 29 * 86400)),
                    'end_time' => time(),
                    'x' => 'thirtyDays',
                    'each' => $monthDay,
                    'view' => $viewDay,
                ],
                [
                    'start_time' => strtotime('2015-5-1'),
                    'end_time' => time(),
                    'x' => 'history'
                ],
            ];
            $count = 1;
            $view = array();
            foreach ($date_times as $date_time) {
                $arr[$count]['data'] = Order::find()
                    ->where(['in','status',[1]])
                    ->andWhere(['between', 'updated_at', $date_time['start_time'], $date_time['end_time']])
                    ->count();
                $arr[$count]['start_time'] = $date_time['start_time'];
                $arr[$count]['end_time'] = $date_time['end_time'];
                if ($count == 1 || $count == 2) {
                    for ($hour = 0; $hour < 24; $hour++) {
                        $arr[$count]['eachData'][$hour] = Order::find()
                            ->where(['in','status',[1]])
                            ->andWhere(['between', 'updated_at', $date_time['each'][$hour], $date_time['each'][$hour + 1]])
                            ->count();
                        $view[$count][] = $arr[$count]['eachData'][$hour];
                    }
                } elseif ($count == 3) {
                    for ($day = 0; $day < 7; $day++) {
                        $arr[$count]['eachData'][$day] = Order::find()
                            ->where(['in','status',[1]])
                            ->andWhere(['between', 'updated_at', $date_time['each'][$day], $date_time['each'][$day + 1]])
                            ->count();
                        $arr[$count]['view'][$day] = $date_time['view'][$day];
                    }
                } elseif ($count == 4) {
                    for ($day = 0; $day < 30; $day++) {
                        $arr[$count]['eachData'][$day] = Order::find()
                            ->where(['in','status',[1]])
                            ->andWhere(['between', 'updated_at', $date_time['each'][$day], $date_time['each'][$day + 1]])
                            ->count();
                        $arr[$count]['view'][$day] = $date_time['view'][$day];
                    }
                }
                $count++;
            }
            $params['data'] = $arr;
        $params['model'] = $model;
        return $this->render('make_count',$params);
    }

    //成交用户
    public function actionMakeUser()
    {
        for ($markZero = 0; $markZero < 25; $markZero++) {
            $todayHour[$markZero] = strtotime(date('Y-m-d', time())) + $markZero * 3600;
            $yesterdayHour[$markZero] = strtotime(date('Y-m-d', time() - 86400)) + $markZero * 3600;
        }
        for ($markDay = 0; $markDay < 7; $markDay++) {
            $weekDay[$markDay] = strtotime(date('Y-m-d', time() - 6 * 86400 + $markDay * 86400));
            $viewWeekDay[$markDay] = date('Y-m-d', $weekDay[$markDay]);
        }
        $weekDay[7] = time();
        for ($markDay = 0; $markDay < 30; $markDay++) {
            $monthDay[$markDay] = strtotime(date('Y-m-d', time() - 29 * 86400 + $markDay * 86400));
            $viewDay[$markDay] = date('m-d', $monthDay[$markDay]);
        }
        $monthDay[30] = time();
        $date_times = [
            [
                'start_time' => strtotime(DateHelper::date(time())),
                'end_time' => time(),
                'x' => 'today',
                'each' => $todayHour,
            ],
            [
                'start_time' => strtotime(DateHelper::date(time() - 86400)),
                'end_time' => strtotime(DateHelper::date(time())),
                'x' => 'yesterday',
                'each' => $yesterdayHour,
            ],
            [
                'start_time' => strtotime(DateHelper::date(time() - 6 * 86400)),
                'end_time' => time(),
                'x' => 'oneWeek',
                'each' => $weekDay,
                'view' => $viewWeekDay,
            ],
            [
                'start_time' => strtotime(DateHelper::date(time() - 29 * 86400)),
                'end_time' => time(),
                'x' => 'thirtyDays',
                'each' => $monthDay,
                'view' => $viewDay,
            ],
            [
                'start_time' => strtotime('2014-10-1'),
                'end_time' => time(),
                'x' => 'history'
            ],
        ];
        $count = 1;
        foreach ($date_times as $date_time) {
            $arr[$count]['data'] = ProjectOrder::find()
                ->where(['in','status',[1,2,3]])
                ->andWhere(['between', 'pay_at', $date_time['start_time'], $date_time['end_time']])
                ->andWhere(['zombie' => 0])
                ->groupBy(['userid'])
                ->count();
            $arr[$count]['start_time'] = $date_time['start_time'];
            $arr[$count]['end_time'] = $date_time['end_time'];
            if ($count == 1 || $count == 2) {
                for ($hour = 0; $hour < 24; $hour++) {
                    $arr[$count]['eachData'][$hour] = ProjectOrder::find()
                        ->where(['in','status',[1,2,3]])
                        ->andWhere(['between', 'pay_at', $date_time['each'][$hour], $date_time['each'][$hour + 1]])
                        ->andWhere(['zombie' => 0])
                        ->groupBy(['userid'])
                        ->count();
                }
            } elseif ($count == 3) {
                for ($day = 0; $day < 7; $day++) {
                    $arr[$count]['eachData'][$day] = ProjectOrder::find()
                        ->where(['in','status',[1,2,3]])
                        ->andWhere(['between', 'pay_at', $date_time['each'][$day], $date_time['each'][$day + 1]])
                        ->andWhere(['zombie' => 0])
                        ->groupBy(['userid'])
                        ->count();
                    $arr[$count]['view'][$day] = $date_time['view'][$day];
                }
            } elseif ($count == 4) {
                for ($day = 0; $day < 30; $day++) {
                    $arr[$count]['eachData'][$day] = ProjectOrder::find()
                        ->where(['in','status',[1,2,3]])
                        ->andWhere(['between', 'pay_at', $date_time['each'][$day], $date_time['each'][$day + 1]])
                        ->andWhere(['zombie' => 0])
                        ->groupBy(['userid'])
                        ->count();
                    $arr[$count]['view'][$day] = $date_time['view'][$day];
                }
            }
            $count++;
        }
        return $this->render('make_user', [
            'data' => $arr,
        ]);
    }

    //成交金额
    public function actionAmountFundRaised()
    {
        $model = new Order();
        $searchModel = new OrderSearch();
        $model->load(\Yii::$app->request->get());
            for ($markZero = 0; $markZero < 25; $markZero++) {
                $todayHour[$markZero] = strtotime(date('Y-m-d', time())) + $markZero * 3600;
                $yesterdayHour[$markZero] = strtotime(date('Y-m-d', time() - 86400)) + $markZero * 3600;
            }
            for ($markDay = 0; $markDay < 7; $markDay++) {
                $weekDay[$markDay] = strtotime(date('Y-m-d', time() - 6 * 86400 + $markDay * 86400));
                $viewWeekDay[$markDay] = date('Y-m-d', $weekDay[$markDay]);
            }
            $weekDay[7] = time();
            for ($markDay = 0; $markDay < 30; $markDay++) {
                $monthDay[$markDay] = strtotime(date('Y-m-d', time() - 29 * 86400 + $markDay * 86400));
                $viewDay[$markDay] = date('m-d', $monthDay[$markDay]);
            }
            $monthDay[30] = time();
            $date_times = [
                [
                    'start_time' => strtotime(DateHelper::date(time())),
                    'end_time' => time(),
                    'x' => 'today',
                    'each' => $todayHour,
                ],
                [
                    'start_time' => strtotime(DateHelper::date(time() - 86400)),
                    'end_time' => strtotime(DateHelper::date(time())),
                    'x' => 'yesterday',
                    'each' => $yesterdayHour,
                ],
                [
                    'start_time' => strtotime(DateHelper::date(time() - 6 * 86400)),
                    'end_time' => time(),
                    'x' => 'oneWeek',
                    'each' => $weekDay,
                    'view' => $viewWeekDay,
                ],
                [
                    'start_time' => strtotime(DateHelper::date(time() - 29 * 86400)),
                    'end_time' => time(),
                    'x' => 'thirtyDays',
                    'each' => $monthDay,
                    'view' => $viewDay,
                ],
                [
                    'start_time' => strtotime('2015-5-1'),
                    'end_time' => time(),
                    'x' => 'history'
                ],
            ];
            $count = 1;
            foreach ($date_times as $date_time) {
                $arr[$count]['data'] = Order::find()
                    ->where(['in','status',[1]])
                    ->andWhere(['between', 'updated_at', $date_time['start_time'], $date_time['end_time']])
                    ->sum('money');
                if(empty($arr[$count]['data'])) {
                    $arr[$count]['data'] = 0 ;
                }
                $arr[$count]['start_time'] = $date_time['start_time'];
                $arr[$count]['end_time'] = $date_time['end_time'];
                if ($count == 1 || $count == 2) {
                    for ($hour = 0; $hour < 24; $hour++) {
                        $arr[$count]['eachData'][$hour] = Order::find()
                            ->where(['in','status',[1]])
                            ->andWhere(['between', 'updated_at', $date_time['each'][$hour], $date_time['each'][$hour + 1]])
                            ->sum('money');
                        if(empty($arr[$count]['eachData'][$hour])) {
                            $arr[$count]['eachData'][$hour] = 0;
                        }
                    }
                } elseif ($count == 3) {
                    for ($day = 0; $day < 7; $day++) {
                        $arr[$count]['eachData'][$day] = Order::find()
                            ->where(['in','status',[1]])
                            ->andWhere(['between', 'updated_at', $date_time['each'][$day], $date_time['each'][$day + 1]])
                            ->sum('money');
                        $arr[$count]['view'][$day] = $date_time['view'][$day];
                    }
                } elseif ($count == 4) {
                    for ($day = 0; $day < 30; $day++) {
                        $arr[$count]['eachData'][$day] = Order::find()
                            ->where(['in','status',[1]])
                            ->andWhere(['between', 'updated_at', $date_time['each'][$day], $date_time['each'][$day + 1]])
                            ->sum('money');
                        if(empty($arr[$count]['eachData'][$day])) {
                            $arr[$count]['eachData'][$day] = 0;
                        }
                        $arr[$count]['view'][$day] = $date_time['view'][$day];
                    }
                }
                $count++;
            }
            $params['data'] = $arr;
        $params['model'] = $model;
        return $this->render('amount_fund_raised',$params);
    }

    public function actionView()
    {
        return $this->render('echarts',[

        ]);
    }
}
