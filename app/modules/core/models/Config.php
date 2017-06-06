<?php

namespace app\modules\core\models;

use Yii;

/**
 * This is the model class for table "{{%core_config}}".
 *
 * @property string $name
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{
    private static $config = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%core_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message'=>'{attribute}必须提供'],
            [['value'], 'string', 'message'=>'{attribute}必须是字符'],
            [['name'], 'string', 'max' => 100, 'message'=>'{attribute}最大长度100'],
            [['name'], 'unique', 'message'=>'{attribute}冲突'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '配置名称',
            'value' => '配置值',
        ];
    }

    /**
     * @配置接口
     * @$name 参数名
     * @$value 参数值
     * @$tmp 是否为临时参数 默认不是 如果是临时参数则不保存到数据库 程序结束自动释放
     */
    public static function Config($name, $value=null, $tmp=false)
    {
        if(empty($name) || strlen($name)>100)
        {
            self::addError('name', '配置值必须为100长度以内的字符');
            return false;
        }
        if(empty($value) || $value==null)
        {
            return self::getConfig($name);
        }else{
            return self::setConfig($name, $value, $tmp);
        }
    }

    /**
     * @设置配置
     */
    private static function setConfig($name, $val, $tmp)
    {
        is_array($val) && $val=json_encode($val);
        if($tmp){
            self::$config[$name]=$val;
            return true;
        }
        $_config=self::find()->where(['name'=>$name])->one();
        if($_config)
        {
            return $_config->updateAttributes(['value'=>$val]);
        }else{
            $_config=new self();
            $_config->name=$name;
            $_config->value=$val;
            return $_config->save(false);
        }
    }

    /**
     * @读取配置
     */
    private static function getConfig($name)
    {
        if( isset(self::$config[$name]) ){
            return self::$config[$name];
        }else{
            $_config=self::find()->where(['name'=>$name])->select('value')->asArray()->one();
            if(isset($_config['value']))
            {
                $_config=json_decode($_config['value'], true);
            }else{
                $_config=false;
            }
            $_config && self::$config[$name]=$_config;
            return $_config;
        }
    }

}
