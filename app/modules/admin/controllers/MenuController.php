<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\Admin;
use app\modules\admin\models\AdminMenu;
use app\modules\core\helps\ToolsService;
use yii\helpers\Json;
use yii\helpers\Url;

class MenuController extends Admin
{

    public function init(){
        parent::init();

    }

    /**
     * 菜单列表
     */
    public function actionIndex() {
        Admin::$core->title='菜单管理';
        return $this->render('list',[
            'list'=>AdminMenu::getTree(),
        ]);
    }

    /**
     * 添加菜单
     */
    public function actionAdd() {
        $this->layout=false;
        Admin::$core->title='添加菜单';
        if( !Yii::$app->request->isPost ){
            return $this->render('post',[
                'list'=>AdminMenu::getSelectList(),
            ]);
        }else{
            $model = new AdminMenu();
            if( $model->load(Yii::$app->request->post()) ){
                if($model->validate() == true && $model->save()){
                    return Json::encode(['status'=>1]);
                }else{
                    return Json::encode(['status'=>0, 'msg'=>'服务器错误']);
                }
            }else{
                return Json::encode(['status'=>0, 'msg'=>'没数据']);
            }
        }
    }

    /**
     * 编辑菜单
     */
    public function actionEdit() {
        return $this->add();
    }

    /**
     * 表单数据前缀方法
     * @param array $vo
     */
    protected function _form_filter(&$vo) {
        if ($this->request->isGet()) {
            // 上级菜单处理
            $_menus = Db::name($this->table)->where('status', '1')->order('sort desc,id desc')->select();
            $_menus[] = ['title' => '顶级菜单', 'id' => '0', 'pid' => '-1'];
            $menus = ToolsService::arr2table($_menus);
            foreach ($menus as $key => &$menu) {
                if (substr_count($menu['path'], '-') > 3) {
                    unset($menus[$key]);
                    continue;
                }
                if (isset($vo['pid'])) {
                    $current_path = "-{$vo['pid']}-{$vo['id']}";
                    if ($vo['pid'] !== '' && (stripos("{$menu['path']}-", "{$current_path}-") !== false || $menu['path'] === $current_path)) {
                        unset($menus[$key]);
                    }
                }
            }
            // 读取系统功能节点
            $nodes = NodeModel::get(APP_PATH);
            foreach ($nodes as $key => $_vo) {
                if (empty($_vo['is_menu'])) {
                    unset($nodes[$key]);
                }
            }
            $this->assign('nodes', array_column($nodes, 'node'));
            $this->assign('menus', $menus);
        }
    }

    /**
     * 删除菜单
     */
    public function del() {
        if (DataService::update($this->table)) {
            $this->success("菜单删除成功！", '');
        }
        $this->error("菜单删除失败，请稍候再试！");
    }

    /**
     * 菜单禁用
     */
    public function forbid() {
        if (DataService::update($this->table)) {
            $this->success("菜单禁用成功！", '');
        }
        $this->error("菜单禁用失败，请稍候再试！");
    }

    /**
     * 菜单禁用
     */
    public function resume() {
        if (DataService::update($this->table)) {
            $this->success("菜单启用成功！", '');
        }
        $this->error("菜单启用失败，请稍候再试！");
    }

}
