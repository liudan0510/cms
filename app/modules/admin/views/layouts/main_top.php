<?php

use yii\helpers\Url;
use app\modules\admin\Admin;

?><div class="framework-topbar">
    <div class="console-topbar">
        <div class="topbar-wrap topbar-clearfix">
            <div class="topbar-head topbar-left">
                <a href="<?=Url::to(['/admin'])?>" class="topbar-logo topbar-left">
                    <span class="icon-logo">App <sup>1.0</sup></span>
                </a>
            </div>
            <?php $pmenu=Admin::$core->menus; ?>
            <?php if( count($pmenu)>0 ) foreach($pmenu as $val): ?>
            <a data-menu-target='m-<?=$val['id']?>' class="topbar-home-link topbar-btn topbar-left">
                <span><?php if( !empty($val['icon']) ): ?><i class="<?=$val['icon']?>"></i><?php endif; ?> <?=$val['title']?></span>
            </a>
            <?php endforeach; ?>

            <div class="topbar-info topbar-right">
                <a data-reload data-tips-text='刷新'
                   class=" topbar-btn topbar-left topbar-info-item text-center"
                   style='width:50px;'>
                    <span class='glyphicon glyphicon-refresh'></span>
                </a>
                <script>
                    require(['jquery'],function(){
                       $('[data-reload]').hover(function(){
                           $(this).find('.glyphicon').addClass('fa-spin');
                       },function(){
                           $(this).find('.glyphicon').removeClass('fa-spin');
                       });
                    });
                </script>
                <div class="topbar-left topbar-user">
                    <div class="dropdown topbar-info-item">
                        <a href="#" class="dropdown-toggle topbar-btn text-center" data-toggle="dropdown">
                            <span class='glyphicon glyphicon-user'></span> Admin </span>
                            <span class="glyphicon glyphicon-menu-up transition" style="font-size:12px"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="topbar-info-btn">
                                <a data-modal="{:url('admin/index/pass')}?id={:session('user.id')}">
                                    <span><i class='glyphicon glyphicon-lock'></i> 修改密码</span>
                                </a>
                            </li>
                            <li class="topbar-info-btn">
                                <a data-modal="{:url('admin/index/info')}?id={:session('user.id')}">
                                    <span><i class='glyphicon glyphicon-edit'></i> 修改资料</span>
                                </a>
                            </li>
                            <li class="topbar-info-btn">
                                <a data-load="{:url('admin/login/out')}" data-confirm='确定要退出登录吗？'>
                                    <span><i class="glyphicon glyphicon-log-out"></i> 退出登录</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>