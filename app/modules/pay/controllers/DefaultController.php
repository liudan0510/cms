<?php

namespace app\modules\pay\controllers;

use app\modules\pay\models\PayList;
use Yii;
use yii\web\Controller;

/**
 * 支付模块
 */
class DefaultController extends Controller
{
    // 支付路由表
    private static $PayList;

    // 命中的支付方式
    private $Pay_select;

    public function init()
    {
        parent::init();
        self::$PayList=PayList::$config;
    }

    /*
     * 支付路由
     * */
    public function actionIndex()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        foreach (self::$PayList as $val)
        {
            if( !is_array($val['keyword']) ){
                if( strpos($user_agent, $val['keyword']) ){
                    $this->Pay_select = $val;
                    break;
                }
            }else{
                foreach ($val['keyword'] as $keyword)
                {
                    if( strpos($user_agent, $keyword) ){
                        $this->Pay_select = $val;
                        break;
                    }
                }
            }
        }

        if( !is_array($this->Pay_select) ){
            $this->Pay_select=[
                'name'=>'网页访问',
                'alias'=>'not-pay',
            ];
        }

        return Yii::$app->runAction(Yii::$app->controller->module->id.'/'.$this->Pay_select['alias'].'/'.Yii::$app->controller->action->id);
    }

}
