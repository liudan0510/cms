<?php

use yii\helpers\Html;

$this->beginPage(); ?><!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="{:sysconf('browser_icon')}" />
        <?= Html::csrfMetaTags() ?>
        <title>{block name="title"}{$title|default=''}&nbsp;{if !empty($title)}-{/if}&nbsp;{:sysconf('site_name')}{/block}</title>
        <link rel="stylesheet" href="<?=Yii::getAlias("@web")?>/static/plugs/bootstrap/css/bootstrap.min.css?ver=<?=date('ymd')?>"/>
        <link rel="stylesheet" href="<?=Yii::getAlias("@web")?>/static/plugs/layui/css/layui.css?ver=<?=date('ymd')?>"/>
        <link rel="stylesheet" href="<?=Yii::getAlias("@web")?>/static/theme/default/css/console.css?ver=<?=date('ymd')?>">
        <link rel="stylesheet" href="<?=Yii::getAlias("@web")?>/static/theme/default/css/animate.css?ver=<?=date('ymd')?>">
        <script>window.ROOT_URL = '<?=Yii::getAlias("@web")?>';</script>
        <script src="<?=Yii::getAlias("@web")?>/static/plugs/require/require.js?ver=<?=date('ymd')?>"></script>
        <script src="<?=Yii::getAlias("@web")?>/static/admin/app.js?ver=<?=date('ymd')?>"></script>
        <?php if(isset($this->blocks['block_header'])): ?><?= $this->blocks['block_header'] ?><?php endif; ?>
        <?php $this->head(); ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <?=$content?>

    <?php if(isset($this->blocks['block_footer'])): ?><?= $this->blocks['block_footer'] ?><?php endif; ?>
    <?php $this->endBody(); ?>
    </body>
</html><?php $this->endPage(); ?>