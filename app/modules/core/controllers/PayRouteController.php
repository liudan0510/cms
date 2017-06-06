<?php

namespace app\modules\admin\controllers;


/**
 * 支付路由
 */
class PayRouteController extends Admin
{

    public $layout='index.php';

    public function init(){
        parent::init();

    }

    public function actionDemo(){
        return $this->render('demo');
    }



}
