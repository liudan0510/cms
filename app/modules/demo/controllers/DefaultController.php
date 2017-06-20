<?php

namespace app\modules\demo\controllers;

//use app\modules\demo\driver\a;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `demo` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return \Yii::$app->runAction('demo/demo/demo');
//        return \Yii::$app->runAction('demo/default/sss');
//
//        $name = Yii::$app->request->get('id');
//        $class = '\\app\\modules\\demo\\driver\\'.$name.'Controller';
//        $app = new $class();
//        return call_user_func([$app,'api']);

    }





}
