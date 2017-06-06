<?php

use app\modules\admin\Admin;
use yii\helpers\Html;

?>
<?= Html::csrfMetaTags() ?>
<div class="ibox">

    <div class="ibox-title">
        <h5><?=isset(Admin::$core->title)?Admin::$core->title:'数据管理'?></h5>
        <div class="nowrap pull-right" style="margin-top:10px">
            <?php if(isset($this->blocks['button'])): ?><?= $this->blocks['button'] ?><?php endif; ?>
        </div>
    </div>

    <div class="ibox-content fadeInUp animated">
        <?=$content?>
    </div>

</div>