<?php

namespace app\modules\pay\models;

/**
 * 支付列表
 */
class PayList extends \yii\db\ActiveRecord
{
    /*
     * name     = 支付名称
     * alias    = 控制器名称
     * keyword  = 支付工具特征关键字
     * */
    public static $config = [

        //支付宝支付
        [
            'name'=>'支付宝',
            'alias'=>'ali-pay',
            'keyword'=>['Alipay','Ali'],
        ],

        //微信支付
        [
            'name'=>'微信支付',
            'alias'=>'wechat-pay',
            'keyword'=>['MicroMessenger','wechat'],
        ],


    ];


}
