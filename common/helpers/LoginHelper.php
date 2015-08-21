<?php

namespace common\helpers;

class LoginHelper
{
    static function isGuest()
    {
        return \Yii::$app->user->isGuest;
    }

    static function isLogin()
    {
        return !self::isGuest();
    }
    static function getUserid()
    {
        if (self::isLogin())
        {
            return \Yii::$app->user->identity->userid;
        }

        return 0;
    }
}