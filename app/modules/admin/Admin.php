<?php

namespace app\modules\admin;

use yii\web\Controller;

class Admin extends Controller
{

    public static $core;

    private $__seettings = [];

    public function __set($id, $value){
        if ( $value === null) {
            unset($this->__seettings[$id]);
            return;
        }
        unset($this->__seettings[$id]);
        $this->__seettings[$id] = $value;
    }

    public function __get($name)
    {
        return $this->has($name) ? $this->__seettings[$name] : parent::__get($name);
    }

    public function __isset($name)
    {
        return $this->has($name) ? true : parent::__isset($name);
    }

    public function has($id)
    {
        return isset($this->__seettings[$id]);
    }

    public function init(){
        parent::init();
        self::$core = $this;
    }

}
