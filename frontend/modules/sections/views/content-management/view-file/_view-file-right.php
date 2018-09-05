<?php

use yii\helpers\Html;
?>
<div class="col-md-4 view-file-right">
    <div class="panel panel-default">
        <div class="panel-heading"><b><?= Yii::t('section','Detail')?></b></div>
        <div class="panel-body">
            <label>
                <i class="fa fa-info-circle" aria-hidden="true"></i> <?= Yii::t('section','Note')?>
            </label>
            <div class="border-bottom">
                <small><?= $dataDefault['description'] ?></small>
            </div>     
            <div class="border-bottom">
                <label>
                    <i class="fa fa-user" aria-hidden="true"></i> <b><?= Yii::t('section','By')?></b> : <?= \common\modules\cores\User::getProfileNameByUserId($dataDefault['user_create']) ?> s
                </label>    
            </div>

             
        </div>
    </div>
    
    <div class="row"> 
        <div class="col-md-12">
            <?php if (!Yii::$app->user->isGuest):  ?>
            <div class="panel panel-default" id="box">
                <div class="panel-heading"><b><?= Yii::t('section','Rules')?></b></div>
                <div class="panel-body">
                   <h4 class="text-left">ขอความอนุเคราะห์ภาพหรือข้อมูล โปรดปฏิบัติตามกติกา ดังนี้ </h4>
                    <div>
                        <p>1. <i class="fa fa-check-square-o"></i> คลิกเลือกภาพหรือข้อมูลที่ต้องการ เลือกลงตะกร้า</p> 
                        <p>2. ระบบจะรวบรวมข้อมูล ออกเป็นแบบฟอร์มให้ท่านกรอกคำร้องขอ</p>
                        <p>3. เมื่อเจ้าหน้าที่ได้รับอีเมล์ จะติดต่อกลับ เพื่อตกลงวิธีส่งมอบข้อมูล</p>
                    </div>
                </div>
            </div>           
            <?php endif; ?>
        </div>
    </div>
    
    <div class="row"> 
        <div class="col-md-12">
            <?php if (!Yii::$app->user->isGuest):  ?>
            <div class="panel panel-default" id="box">                 
                <div class="panel-body">
                   <div class="text-center" style="">
                       <button style="padding:10px;font-size:16pt;" class="btn btn-success btn-lg btn-block" id="btnCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= Yii::t('section', 'Add to cart') ?></button>
                   </div>
                </div>
            </div>           
            <?php endif; ?>
        </div>
    </div>
</div>

<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    
    .border-bottom{
        border-bottom: 1px solid #ecf0f5;
        border-bottom-style: dashed;
        padding-bottom: 10px;
        padding-top: 10px;
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>

<?php
$modal = "modal-contents";
?>
