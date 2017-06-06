<?php

namespace app\modules\admin\controllers;

use app\modules\admin\Admin;
use app\modules\admin\models\AdminMenu;
use yii\helpers\Url;
use app\modules\core\helps\ToolsService;

/**
 * Default controller for the `admin` module
 */
class PublicController extends Admin
{

    public function init(){
        parent::init();

    }

    /**
     * 字体图标
     */
    public function actionIco() {
        $this->layout=false;
        return $this->render('ico',[
            'field'=>'icon'
        ]);
    }


    /**
     * 默认检查用户登录状态
     * @var bool
     */
    protected $checkLogin = false;

    /**
     * 默认检查节点访问权限
     * @var bool
     */
    protected $checkAuth = false;

    /**
     * 文件上传
     * @return \think\response\View
     */
    public function upfile() {
        $types = $this->request->get('type', 'jpg,png');
        $mode = $this->request->get('mode', 'one');
        $this->assign('mode', $mode);
        $this->assign('types', $types);
        if (!in_array(($uptype = $this->request->get('uptype')), ['local', 'qiniu'])) {
            $uptype = sysconf('storage_type');
        }
        $this->assign('uptype', $uptype);
        $this->assign('mimes', FileService::getFileMine($types));
        $this->assign('field', $this->request->get('field', 'file'));
        return view();
    }

    /**
     * 通用文件上传
     * @return string
     */
    public function upload() {
        if ($this->request->isPost()) {
            $md5s = str_split($this->request->post('md5'), 16);
            if (($info = $this->request->file('file')->move('static' . DS . 'upload' . DS . $md5s[0], $md5s[1], true))) {
                $filename = join('/', $md5s) . '.' . $info->getExtension();
                $site_url = FileService::getFileUrl($filename, 'local');
                if ($site_url) {
                    return json(['data' => ['site_url' => $site_url], 'code' => 'SUCCESS']);
                }
            }
        }
        return json(['code' => 'ERROR']);
    }

    /**
     * 文件状态检查
     */
    public function upstate() {
        $post = $this->request->post();
        $filename = join('/', str_split($post['md5'], 16)) . '.' . pathinfo($post['filename'], PATHINFO_EXTENSION);
        // 检查文件是否已上传
        if (($site_url = FileService::getFileUrl($filename))) {
            $this->result(['site_url' => $site_url], 'IS_FOUND');
        }
        // 需要上传文件，生成上传配置参数
        $config = ['uptype' => $post['uptype'], 'file_url' => $filename];
        switch (strtolower($post['uptype'])) {
            case 'qiniu':
                $config['server'] = FileService::getUploadQiniuUrl(true);
                $config['token'] = $this->_getQiniuToken($filename);
                break;
            case 'local':
                $config['server'] = FileService::getUploadLocalUrl();
                break;
        }
        $this->result($config, 'NOT_FOUND');
    }

    /**
     * 生成七牛文件上传Token
     * @param string $key
     * @return string
     */
    protected function _getQiniuToken($key) {
        empty($key) && exit('param error');
        $accessKey = sysconf('storage_qiniu_access_key');
        $secretKey = sysconf('storage_qiniu_secret_key');
        $bucket = sysconf('storage_qiniu_bucket');
        $host = sysconf('storage_qiniu_domain');
        $protocol = sysconf('storage_qiniu_is_https') ? 'https' : 'http';
        $params = [
            "scope"      => "{$bucket}:{$key}",
            "deadline"   => 3600 + time(),
            "returnBody" => "{\"data\":{\"site_url\":\"{$protocol}://{$host}/$(key)\",\"file_url\":\"$(key)\"}, \"code\": \"SUCCESS\"}",
        ];
        $data = str_replace(['+', '/'], ['-', '_'], base64_encode(json_encode($params)));
        return $accessKey . ':' . str_replace(['+', '/'], ['-', '_'], base64_encode(hash_hmac('sha1', $data, $secretKey, true))) . ':' . $data;
    }

}
