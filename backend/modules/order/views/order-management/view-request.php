<?php
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
$this->title = Yii::t('order', 'ดูคำร้อง');
\Yii::$app->name = "Siriraj";
$date = isset($model->date) ? appxq\sdii\utils\SDdate::mysql2phpDate($model->date) : "";
//$modelForm=['product'=>$product,'count'=>$count,'detail'=>$model['note'],'date'=>$model->date, 'sitecode'=>$model->sitecode, 'name'=>"{$model['firstname']} {$model['lastname']}", 'title'=>$title, 'address'=>$model->companey_name, 'tel'=>$model->tel]; 
//$modelForm = ['product' => isset($product) ? $product : '', 'count' => isset($count) ? $count : '', 'detail' => isset($model['note']) ? $model['note'] : '', 'date' => $date, 'sitecode' => isset($model->sitecode) ? $model->sitecode : '', 'name' => "{$model['firstname']} {$model['lastname']}", 'title' => $title, 'address' => isset($model->companey_name) ? $model->companey_name : '', 'tel' => isset($model->tel) ? $model->tel : ''];
$shipper = \common\models\Shipper::findOne($id);

$firstname = isset($shipper['firstname']) ? $shipper['firstname'] : '';
$lastname = isset($shipper['lastname']) ? $shipper['lastname'] : '';
$fullName = "{$firstname} {$lastname}";
$sitecode = isset($shipper['sitecode']) ? $shipper['sitecode'] : '';
$note = isset($shipper['note']) ? $shipper['note'] : '';
$tel = isset($shipper['tel']) ? $shipper['tel'] : '';
$email = isset($shipper['email']) ? $shipper['email'] : '';
$position = isset($shipper['position']) ? $shipper['position'] : '';
//appxq\sdii\utils\VarDumper::dump($note);
$modelForm = [
    'product' => isset($product) ? $product : '',
    'count' => isset($count) ? $count : '',
    'note' => $note,
    'date' => date('d/m/Y'),
    'sitecode' => $sitecode,
    'fname' => $firstname,
    'lname' => $lastname,
    'name' => $fullName,
    'tel' => $tel,
    'position' => $position,
    'email' => $email
];
$data = \backend\modules\sections\classes\JFiles::getTemplateMark($modelForm, $template->option_value);
?>

<link href="<?= \yii\helpers\Url::to('@web/css/bootstrap.min.css') ?>" rel="stylesheet" />
<div class="container text-center" style="margin-bottom:10px;">
    <a href="<?= \yii\helpers\Url::to(['/order/order-management/index'])?>" class="btn btn-default"><i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ</a>
    <a data-id="<?= $id?>" href="<?= \yii\helpers\Url::to(['/order/order-management/download'])?>" class="btn btn-primary btnDownload"><i class="fa fa-download" aria-hidden="true"></i> ดาวน์โหลด</a>
</div>
<div class="container" id="a4-prine">
    
    <?php
    echo $data;
    ?>
</div>


<?php appxq\sdii\widgets\CSSRegister::begin() ?>
<style>
    body {
        background: #858589 !important;
    }
    #a4-prine{
        font-size:12pt;
        width: 210mm;
        /*border: 1px solid #333333;*/
        background: #f4f4f4;
        height: 297mm;
        padding: 27mm 16mm 27mm 16mm;
    }
    .f-t-11{
        font-size:11pt;
    }
    @media print {
        #a4-prine{
            width: null;
            border: 0;
            background: #fff;
            height: 297mm;
            padding: 27mm 16mm 27mm 16mm;
        }
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end() ?>
<?php \richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.btnDownload').on('click', function(){
        let url = $(this).attr('href');
        let id = $(this).attr('data-id');
        $.get(url, {id:id}, function(result){
              if(result.status == 'success') {
                    <?= SDNoty::show('result.message', 'result.status') ?>
		   // console.log(result);
                   // $('#downloadFile').attr('href', result['data']['filename']);
                    let uri = `${result['data']['path']}/${result['data']['filename']}`;
                    window.open(uri, '_BLANK');
		} else {
                    <?= SDNoty::show('result.message', 'result.status') ?>
		}
        }); 
        return false;
}); 
</script>
<?php \richardfan\widget\JSRegister::end(); ?>
