<?php
    use yii\helpers\Html;
    $this->title = Yii::t('order', "Send Mail");
?>
<br>
<div class="box box-primary">
    <div class="box-header"><i class="fa fa-envelope"></i> <?=  Html::encode($this->title)?></div>
    <div class="box-body">
        <?php 
            $email = "chanpan.nuttaphon1993@gmail.com";//Yii::$app->user->identity->email;
            $result = \Yii::$app->mailer->compose()
                    ->setFrom(['ncrc.damasac@gmail.com' => "test sendmil"])
                    ->setTo($email)
                    ->setSubject('คำถามของคุณที่ ' . \Yii::$app->name)
                    ->setTextBody('หัวข้อ ติดตามคำถามของคุณได้ที่ : test') //เลือกอยางใดอย่างหนึ่ง
                    ->setHtmlBody('หัวข้อ  ติดตามคำถามของคุณได้ที่ : test ') //เลือกอยางใดอย่างหนึ่ง
                    ->send();
            echo $result;
        ?>
    </div>
</div>