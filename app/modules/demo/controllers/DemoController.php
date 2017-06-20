<?php

namespace app\modules\demo\controllers;

//use app\modules\demo\driver\a;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `demo` module
 */
class DemoController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionDemo()
    {
        return $this->render('index');


    }





}
