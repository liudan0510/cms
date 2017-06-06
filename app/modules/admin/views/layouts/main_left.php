<?php

use app\modules\admin\Admin;

?><div class="framework-sidebar">
    <div class="sidebar-content">
        <div class="sidebar-inner">
            <div class="sidebar-fold">
                <span class="glyphicon glyphicon-option-vertical transition"></span>
            </div>
            <?php $_menu=Admin::$core->menus; ?>
            <?php if( count($_menu)>0 ) foreach($_menu as $pmenu): ?>
                <?php if( is_array($pmenu['sub']) ): ?>
                <div data-menu-box="m-<?=$pmenu['id']?>">
                    <?php foreach ($pmenu['sub'] as $menu): ?>
                    <div class="sidebar-nav main-nav">
                        <?php if( !isset($menu['sub']) || !is_array($menu['sub']) ){ ?>
                        <ul class="sidebar-trans">
                            <li class="nav-item">
                                <a data-menu-node='m-<?=$pmenu['id']?>-<?=$menu['id']?>' data-open="<?=$menu['url']?>"
                                   class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans">
                                        <span class="<?=$menu['icon']?$menu['icon']:'fa fa-link'?> transition"></span>
                                    </div>
                                    <span class="nav-title"><?=$menu['title']?></span>
                                </a>
                            </li>
                        </ul>
                        <?php }else{ ?>
                        <div class="sidebar-title">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon fa fa-caret-right transition"></span>
                                <span class="sidebar-title-text"><?=$menu['title']?></span>
                            </div>
                        </div>
                        <ul class="sidebar-trans" style="display:none" data-menu-node='m-{$pmenu.id}-{$menu.id}'>
                            <?php foreach ($menu['sub'] as $submenu): ?>
                            <li class="nav-item">
                                <a data-menu-node='m-<?=$pmenu['id']?>-<?=$submenu['id']?>' data-open="<?=$submenu['url']?>"
                                   class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans">
                                        <span class="<?=$submenu['icon']?$submenu['icon']:'fa fa-link'?> transition"></span>
                                    </div>
                                    <span class="nav-title"><?=$submenu['title']?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                            <?php } ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>