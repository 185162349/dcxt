<?php

namespace common\helpers;


use frontend\controllers\MessageController;
use yii\helpers\Html;
use yii\validators\Validator;

/**
 *  err 错误编码格式 (重要)
 *      ok 成功
 *      err_xxx 错误,
 *      err_nologin 未登录
 */
class AppHelper
{
    static function goBack()
    {
        return \Yii::$app->controller->goBack();
    }

    static function setReturnUrl($url)
    {
        return \Yii::$app->getUser()->setReturnUrl($url);
    }

    static function getReturnUrl()
    {
        return \Yii::$app->getUser()->getReturnUrl();
    }

    static function get($name = null, $defaultValue = null)
    {
        return \Yii::$app->request->get($name, $defaultValue);
    }

    static function getInt($name = null, $defaultValue = null)
    {
        $v = self::get($name, $defaultValue);
        return intval($v);
    }

    static function post($name = null, $defaultValue = null)
    {
        return \Yii::$app->request->post($name, $defaultValue);
    }

    static function postInt($name = null, $defaultValue = null)
    {
        $v = self::post($name, $defaultValue);
        return intval($v);
    }

    static function isPost()
    {
        return \Yii::$app->request->isPost;
    }


    static function isAjax()
    {
        return \Yii::$app->request->isAjax;
    }

    static function isPjax()
    {
        return \Yii::$app->request->isPjax;
    }

    static function loadModel($model)
    {
        return $model->load(\Yii::$app->request->post());
    }

    static function setFLash($key, $value = true)
    {
        \Yii::$app->getSession()->setFlash($key, $value);
    }

    static function getFlash($key, $defaultValue = null, $delete = false)
    {
        return \Yii::$app->getSession()->getFlash($key, $defaultValue, $delete);
    }

    /**
     * @param $json_arr
     * @return mixed
     */
    static function echoJson($json_arr)
    {
        \Yii::$app->response->format = 'json';

        if (!isset($json_arr['msg'])) {
            $json_arr['msg'] = '';
        }

        return ($json_arr);
    }

    /**
     * 输出成功信息
     */
    static function okJson()
    {
        $json_arr = array(
            "err" => 'ok',
            "msg" => '',
        );

        return self::echoJson($json_arr);
    }

    /**
     * 输出错误信息
     */
    static function msgJson($msg = '', $err = 'err_system')
    {
        $json_arr = array(
            "err" => $err,
            "msg" => $msg, // 提示信息
        );

        return self::echoJson($json_arr);
    }


    /**
     * 输出跳转信息
     */
    static function urlJson($url, $msg = '', $err = 'ok')
    {
        $json_arr = array(
            "err" => $err,
            "msg" => $msg, // 提示信息
            "url" => $url, // 跳转的URL
        );

        return self::echoJson($json_arr);
    }

    /**
     * 输出Form提交错误信息
     */
    static function formJson($form = array(), $msg = '', $err = 'err_form')
    {
        $json_arr = array(
            "err" => $err,
            "msg" => $msg, // 提示信息
            'form' => $form,
        );

        return self::echoJson($json_arr);
    }


    /**
     * 输出附加错误码的json数据
     */
    static function dataJson($json_data, $err = 'ok', $msg = '')
    {
        $json_arr = array(
            "err" => $err,
            "msg" => $msg,
            "data" => $json_data,
        );

        return self::echoJson($json_arr);
    }
}
