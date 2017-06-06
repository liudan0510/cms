<?php

namespace app\modules\pay\controllers;
use app\modules\pay\Pay as BASE;

/**
* 支付宝
*/
class AliPayController extends BASE
{

    public function actionIndex()
    {
        return \Yii::$app->controller->id;
    }

}
 