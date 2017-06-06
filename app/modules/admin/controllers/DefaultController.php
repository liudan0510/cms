<?php

namespace app\modules\admin\controllers;

use app\modules\admin\Admin;
use app\modules\admin\models\AdminMenu;
use yii\helpers\Url;
use app\modules\core\helps\ToolsService;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Admin
{

    public $layout='index.php';

    public function init(){
        parent::init();

    }

    public function actionDemo(){
        return $this->render('demo');
    }

    public function actionDemos(){
        return time().'Dannill';
    }

    public function actionIndex()
    {
//        NodeModel::applyAuthNode();
        $list = AdminMenu::find()->where(['status'=>1])->orderBy('sort ASC,id ASC')->asArray()->all();
        $menus = $this->_filterMenu(ToolsService::arr2tree($list));
        Admin::$core->menus=$menus;
        return $this->render('index');
    }

    /**
     * 后台主菜单权限过滤
     * @param array $menus
     * @return array
     */
    private function _filterMenu($menus) {
        foreach ($menus as $key => &$menu) {
            if (!empty($menu['sub'])) {
                $menu['sub'] = $this->_filterMenu($menu['sub']);
            }
            if (!empty($menu['sub'])) {
                $menu['url'] = '#';
            } elseif (stripos($menu['url'], 'http') === 0) {
                continue;
//            } elseif ($menu['url'] !== '#' && auth(join('/', array_slice(explode('/', $menu['url']), 0, 3)))) {
            } elseif ($menu['url'] !== '#' ) {
                $menu['url'] = Url::to($menu['url']);
            } else {
                unset($menus[$key]);
            }
        }
        return $menus;
    }

}
