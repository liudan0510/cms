<?php

namespace app\modules\core;

use Yii;
use yii\base\BootstrapInterface;
use yii\helpers\Url;
use yii\web\Application;
use yii\web\View;

/**
 * core module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    const VERSION = 0.1;

    public $settings;

    public function init()
    {
        parent::init();

        $modules = [
            'core' => [
                'class' => 'app\modules\core\Module',
            ],
            'pay' => [
                'class' => 'app\modules\pay\Module',
            ],
            'demo' => [
                'class' => 'app\modules\demo\Module',
            ],
            'admin' => [
                'class' => 'app\modules\admin\Module',
            ],
        ];

        Yii::$app->setModules($modules);

    }

    public function bootstrap($app)
    {
//        $app->on(Application::EVENT_BEFORE_REQUEST, function () use ($app) {
//            $app->getView()->on(View::EVENT_BEGIN_BODY, [$this, 'renderToolbar']);
//        });
    }

    /*获取已安装模块*/
    public function getInstalled()
    {
        if($this->_installed === null) {
            try {
                $this->_installed = Yii::$app->db->createCommand("SHOW TABLES LIKE 'easyii_%'")->query()->count() > 0 ? true : false;
            } catch (\Exception $e) {
                $this->_installed = false;
            }
        }
        return $this->_installed;
    }

}
