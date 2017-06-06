<?php

namespace app\modules\admin;

use GuzzleHttp\Psr7\Request;
use Symfony\Component\BrowserKit\Response;
use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $layout  = 'main.php';

    public static $TPL;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // 权限检测


    }
}
