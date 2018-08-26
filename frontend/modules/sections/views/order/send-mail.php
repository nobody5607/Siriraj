<?php

use yii\helpers\Html;

$this->title = Yii::t('order', "Send Email");
\Yii::$app->name = "Siriraj";
$modelForm = ['product' => $product, 'count' => $count, 'detail' => $model['note'], 'date' => appxq\sdii\utils\SDdate::mysql2phpDate($model->date), 'sitecode' => $model->sitecode, 'name' => "{$model['firstname']} {$model['lastname']}", 'title' => $title, 'address' => $model->companey_name, 'tel' => $model->tel];
$data = \backend\modules\sections\classes\JFiles::getTemplateMark($modelForm, $template->option_value);
$email_default = \backend\modules\cores\classes\CoreOption::getParams('email_request');
?>
<br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header"><i class="fa fa-envelope"></i> <?= Html::encode($this->title) ?></div>
            <div class="box-body">
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
                    <a href="#" class="btn btn-block btn-success btnSendMail"><?= Yii::t('order', 'Send') ?></a>
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