<?php

use yii\helpers\Html;

$this->title = Yii::t('order', "Send Email");
\Yii::$app->name = "Siriraj";
$date = isset($model->date) ? appxq\sdii\utils\SDdate::mysql2phpDate($model->date) : "";
$modelForm = ['product' => isset($product) ? $product : '', 'count' => isset($count) ? $count : '', 'detail' => isset($model['note']) ? $model['note'] : '', 'date' => $date, 'sitecode' => isset($model->sitecode) ? $model->sitecode : '', 'name' => "{$model['firstname']} {$model['lastname']}", 'title' => $title, 'address' => isset($model->companey_name) ? $model->companey_name : '', 'tel' => isset($model->tel) ? $model->tel : ''];
$data = \backend\modules\sections\classes\JFiles::getTemplateMark($modelForm, $template->option_value);
$email_default = \backend\modules\cores\classes\CoreOption::getParams('email_request');
?>
<br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> <?= Html::encode($this->title) ?>
                <div class="pull-right"><a class="btn btn-sm btn-primary" target="_BLANK" href="/sections/order/print?id==<?= Yii::$app->request->get('id')?>&type=print"><?= Yii::t('section','Preview Form')?></a></div>
            </div>
            <div class="panel-body">
                <?php 
                    if($email){
                        echo "<div class='alert alert-info'>Send email {$email} success</div>";
                    }
                ?>
                <div class="form-group">
                    <label><?= Yii::t('order', 'Email')?> : </label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $email_default['option_value'] ?>"/>
                </div>
                <div>
                    <a href="#" class="btn btn-block btn-success btnSendMail btn-lg"><?= Yii::t('order', 'Send') ?></a>
                </div>
                <?php
                if($email){
                    
                    \Yii::$app->mailer->compose()
                    ->setFrom(['ncrc.damasac@gmail.com' => "Siriraj"])
                    ->setTo($email)
                    ->setSubject('แบบฟอร์มและหนังสือขอภาพพิพิธภัณฑ์ ' . \Yii::$app->name) 
                    ->setHtmlBody($data) //เลือกอยางใดอย่างหนึ่ง
                    ->send();
                }
                 
                ?>
            </div>
        </div>  
    </div>
</div>

<?php \richardfan\widget\JSRegister::begin();?>
<script>
     $('.btnSendMail').on('click', function(){
       let email = $('#email').val();  
       let url = '/sections/order/print?id=<?= $_GET['id']?>&type=mail&email='+email;  
       location.href = url;
       return false; 
    }); 
</script>
<?php \richardfan\widget\JSRegister::end();?>
<?php \appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    .form-control{
         font-size: 1.25rem;
    }
    .btn-group-lg>.btn, .btn-lg {
        padding: .5rem 1rem;
        font-size: 2.25rem;
        line-height: 1.5;
        border-radius: .3rem;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>