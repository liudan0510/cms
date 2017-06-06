<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;
use app\modules\core\helps\ToolsService;

/**
 * This is the model class for table "{{%admin_menu}}".
 *
 * @property string $id
 * @property string $pid
 * @property string $title
 * @property string $node
 * @property string $icon
 * @property string $url
 * @property string $params
 * @property string $target
 * @property integer $sort
 * @property integer $status
 * @property string $create_by
 * @property string $create_at
 */
class AdminMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort', 'status', 'create_by'], 'integer'],
            [['create_at'], 'safe'],
            [['title', 'icon'], 'string', 'max' => 100],
            [['node'], 'string', 'max' => 200],
            [['url'], 'string', 'max' => 400],
            [['params'], 'string', 'max' => 500],
            [['target'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\modules\core\l', 'ID'),
            'pid' => Yii::t('app\modules\core\l', '父id'),
            'title' => Yii::t('app\modules\core\l', '名称'),
            'node' => Yii::t('app\modules\core\l', '节点代码'),
            'icon' => Yii::t('app\modules\core\l', '菜单图标'),
            'url' => Yii::t('app\modules\core\l', '链接'),
            'params' => Yii::t('app\modules\core\l', '链接参数'),
            'target' => Yii::t('app\modules\core\l', '链接打开方式'),
            'sort' => Yii::t('app\modules\core\l', '菜单排序'),
            'status' => Yii::t('app\modules\core\l', '状态(0:禁用,1:启用)'),
            'create_by' => Yii::t('app\modules\core\l', '创建人'),
            'create_at' => Yii::t('app\modules\core\l', '创建时间'),
        ];
    }

    /*
     * 返回菜单 Tree
     * */
    public static function getTree(){
        $data = self::find()->orderBy('sort asc,id asc')->asArray()->all();
        foreach ($data as &$vo) {
            ($vo['url'] !== '#') && ($vo['url'] = Url::to([$vo['url']]));
            $vo['ids'] = join(',', ToolsService::getArrSubIds($data, $vo['id']));
        }
        return ToolsService::arr2table($data);
    }

    /**
     * 返回菜单 select
     */
    public static function getSelectList($select_id=null) {
        $andWhere='';
        if( $select_id>0 ){
            $andWhere = ['<>','id',$select_id];
        }
        $_menus = self::find()->where(['status'=>1])->andWhere($andWhere)->orderBy('sort desc,id desc')->asArray()->all();
        $_menus[] = ['title' => '顶级菜单', 'id' => '0', 'pid' => '-1'];
        $menus = ToolsService::arr2table($_menus);
        foreach ($menus as $key => $menu) {
            if (substr_count($menu['path'], '-') > 3) {
                unset($menus[$key]);
                continue;
            }
        }
        return $menus;
    }

}
