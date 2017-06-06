<?php

namespace app\modules\pay\controllers;
use app\modules\pay\Pay as BASE;

/**
* 微信支付
*/
class WechatPayController extends BASE
{

    public function actionIndex()
    {
        return \Yii::$app->controller->id;
    }

}
