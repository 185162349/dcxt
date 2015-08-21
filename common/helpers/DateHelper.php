<?php

/**
 * 时间日期相关
 */

namespace common\helpers;


class DateHelper
{
    static function datetime($time = null)
    {
        return date("Y-m-d H:i:s", $time);
    }

    static function shortTime($time = null)
    {
        return date("Y-m-d H:i", $time);
    }

    static function date($time = null)
    {
        return date("Y-m-d", $time);
    }

    /**
     * 当天
     * <1分钟 X秒前
     * >1分钟 X分钟前
     * >60分钟 今天 具体时间（今天 15:36）
     * >60分钟*24且在本月内    x月x日 具体时间（7月25日 15:24）
     * 跨月   201x-x-x 具体时间（2014-6-15 23:54）
     */
    static function cnTime($at)
    {
        $t = time() - $at;
        if ($t < 60) {
            return $t . "秒前";
        } elseif ($t < 60 * 60) { //60分钟内
            return floor($t / 60) . "分钟前";
        } elseif (date("Ymd", $at) == date("Ymd")) { //今天
            return '今天 ' . Date("H:i", $at);
        } elseif (date("Ym", $at) == date("Ym")) { //月内
            return date("n月j日 H:i", $at); //不带前导0, 时分没有不带前导0的格式
        } else {
            return date("Y-n-j H:i", $at);
        }
    }


    /**
     * 计算某日期的开始和结算天
     * @param $date
     * @param int $step
     * @return string
     */
    static function month_fstlst_date($date, $step = 0)
    {
        $date = date("Y-m-d", strtotime($step . " months", strtotime($date))); //得到处理后的日期（得到前后月份的日期）
        $u_date = strtotime($date);
        $days = date("t", $u_date); // 得到结果月份的天数

        //月份第一天的日期
        $first_date = date("Y-m-01", $u_date);
        //$last_date = date("Y-m-d", strtotime($first_date) + ($days * 3600 * 24));
        $last_date = date("Y-m-{$days}", $u_date);
        return array(
            'first' => $first_date,
            'last' => $last_date,
        );
    }

    static function month_first_date($date, $step = 0)
    {
        $arr = self::month_fstlst_date($date, $step);
        return @$arr['first'];
    }

    static function month_last_date($date, $step = 0)
    {
        $arr = self::month_fstlst_date($date, $step);
        return @$arr['last'];
    }

    static function month_fstlst_time($date, $step = 0)
    {
        $arr = self::month_fstlst_date($date, $step);
        return array(
            'first' => @$arr['first'] . ' 00:00:00',
            'last' => @$arr['last'] . ' 23:59:59',
        );
    }

    static function month_first_time($date, $step = 0)
    {
        $arr = self::month_fstlst_time($date, $step);
        return @$arr['first'];
    }

    static function month_last_time($date, $step = 0)
    {
        $arr = self::month_fstlst_time($date, $step);
        return @$arr['last'];
    }
}

//echo DateHelper::cnTime(strtotime("2014-07-04 23:06:07"));
/*
echo date_util::date();
echo "\n";
echo date_util::datetime();
echo "\n";
$x = date_util::month_first_date('2014-03-24');
print_r($x);
echo "\n";
$x = date_util::month_last_date('2014-03-24');
print_r($x);
echo "\n";
$x = date_util::month_fstlst_date('2014-03-24');
print_r($x);

echo "\n";
$x = date_util::month_fstlst_date('2014-02-1');
print_r($x);

echo "\n";
$x = date_util::month_fstlst_date('2000-01-28', 1);
print_r($x);

$x = date_util::month_fstlst_time('2000-01-28', 1);
print_r($x);
*/
