<?php

use yii\helpers\Url;
use yii\helpers\Html;

?><form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="<?=Url::to()?>" data-auto="true" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->getRequest()->getCsrfToken()?>">
    <div class="layui-form-item">
        <label class="layui-form-label">上级菜单</label>
        <div class="layui-input-block">
            <select name='AdminMenu[pid]' class='layui-select full-width' style='display:block'>
                <?php if( isset($list) && count($list)>0 ) foreach ($list as $menu): ?>
                <?php if( (!isset($data['pid']) && $menu['id']==0) || (isset($data['pid']) && $menu['id']==$data['pid']) ){ ?>
                    <option selected value='<?=$menu['id']?>'><?=$menu['spl']?><?=$menu['title']?></option>
                <?php }else{ ?>
                    <option  value='<?=$menu['id']?>'><?=$menu['spl']?><?=$menu['title']?></option>
                <?php } ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单名称</label>
        <div class="layui-input-block">
            <input type="text" name="AdminMenu[title]" value='<?= isset($data['title'])?$data['title']:'' ?>' required="required" title="请输入菜单名称" placeholder="请输入菜单名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单链接</label>
        <div class="layui-input-block">
            <input type="text" onblur="(this.value === '') && (this.value = '#')" name="AdminMenu[url]" autocomplete="off" required="required" title="请输入菜单链接" placeholder="请输入菜单链接" value="<?= isset($data['url'])?$data['url']:'#' ?>" class="layui-input typeahead">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单图标</label>
        <div class="layui-input-inline" style='width:300px'>
            <input placeholder="请输入或选择图标" onchange="$('#icon-preview').get(0).className = this.value" type="text" name="AdminMenu[icon]" value='<?= isset($data['icon'])?$data['icon']:'' ?>' class="layui-input">
        </div>
        <span class='layui-btn layui-btn-primary' style='padding:0 12px;min-width:45.2px'>
            <i id='icon-preview' style='font-size:1.2em' class='<?= isset($data['icon'])?$data['icon']:'' ?>'></i>
        </span>
        <button data-icon='icon' type='button' class='layui-btn layui-btn-primary'>选择图标</button>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="layui-form-item text-center">
        <?php if(isset($data['id'])): ?><input type='hidden' value='<?= $data['id'] ?>' name='id'/><?php endif; ?>
        <button class="layui-btn" type='submit'>保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close>取消编辑</button>
    </div>
    <script>
        require(['bootstrap.typeahead'], function () {
            var subjects = JSON.parse('{$nodes|json_encode}');
            $('.typeahead').typeahead({source: subjects, items: 5});
        });
    </script>
</form>
