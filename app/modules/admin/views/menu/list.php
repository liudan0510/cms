<?php

use yii\helpers\Url;
?>

<?php $this->beginBlock('button'); ?>
    <button data-modal='<?=Url::to(['add'])?>' data-title="添加" class='layui-btn layui-btn-small'><i class='fa fa-plus'></i> 添加菜单</button>
    <button data-update data-field='delete' data-action='<?=Url::to(['del'])?>' class='layui-btn layui-btn-small layui-btn-danger'><i class='fa fa-remove'></i> 删除菜单</button>
<?php $this->endBlock(); ?>

<form onsubmit="return false;" data-auto="" method="POST">
    <input type="hidden" value="resort" name="action" />
    <table class="table table-hover">
        <thead>
        <tr>
            <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='list-table-sort-td'>
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-mini">排 序</button>
            </th>
            <th class='text-center'></th>
            <th>菜单名称</th>
            <th class='visible-lg'>菜单链接</th>
            <th class='text-center'>状态</th>
            <th class='text-center'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if( isset($list) && count($list)>0 ) foreach ($list as $val): ?>
        <tr>
            <td class='list-table-check-td'>
                <input class="list-check-box" value='<?= isset($val['ids'])?$val['ids']:'' ?>' type='checkbox'/>
            </td>
            <td class='list-table-sort-td'>
                <input name="_<?= isset($val['id'])?$val['id']:'' ?>" value="<?= isset($val['sort'])?$val['sort']:0 ?>" class="list-sort-input"/>
            </td>
            <td class='text-center'>
                <i style="font-size:18px;" class="<?= isset($val['icon'])?$val['icon']:'' ?>"></i>
            </td>
            <td><?= isset($val['spl'])?$val['spl']:'' ?><?= isset($val['title'])?$val['title']:'' ?></td>
            <td class='visible-lg'><?= isset($val['url'])?$val['url']:'' ?></td>
            <td class='text-center'>
                <?php if( isset($val['status']) && $val['status']==0 ){ ?>
                    <span>已禁用</span>
                <?php }elseif( isset($val['status']) && $val['status']==1 ){ ?>
                    <span style="color:#090">使用中</span>
                <?php } ?>
            </td>
            <td class='text-center nowrap'>
                <?php if(1==1): ?>
                    <span class="text-explode">|</span>
                    <a data-modal='<?= Url::to(['edit','id'=>$val['id']]) ?>' href="javascript:void(0)">编辑</a>
                <?php endif; ?>
                <?php if(1==1): ?>
                    <span class="text-explode">|</span>
                    <a data-update="{$vo.ids}" data-field='status' data-value='0'data-action='{:url("$classuri/forbid")}' href="javascript:void(0)">禁用</a>
                    <span class="text-explode">|</span>
                    <a data-update="{$vo.ids}" data-field='status' data-value='1' data-action='{:url("$classuri/resume")}' href="javascript:void(0)">启用</a>
                <?php endif; ?>
                <?php if(1==1): ?>
                    <span class="text-explode">|</span>
                    <a data-update="{$vo.ids}" data-field='delete' data-action='{:url("$classuri/del")}' href="javascript:void(0)">删除</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</form>