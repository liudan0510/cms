<?php

namespace app\modules\pay;

use  Yii;
/**
 * 支付模块
 *
 * 底层路由
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\pay\controllers';

    public function init()
    {
        parent::init();

    }

}
