<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
 
 
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\viewcountermanagement\models\ViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content', 'สถิติการเข้าใช้งาน');
$this->params['breadcrumbs'][] = $this->title;
 
?>

<div class="box box-primary">
    <div class="box-header"></div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?= Yii::t('view','Select Year')?></label>
                    <?php 
                        $itemYear = ['2018'=>'2561'];
                        $itemMonth = ['01'=>"ม.ค.", '02'=>"ก.พ.", '03'=>"มี.ค.", '04'=>"เม.ย.", '05'=>"พ.ค.", '06'=>"มิ.ย.", '07'=>"ก.ค.",'08'=>"ส.ค.",'09'=>"ก.ย.",'10'=>"ต.ค.",'11'=>"พ.ย.",'12'=>"ธ.ค."]
                    ?>
                    <?= Html::dropDownList("year", '', $itemYear, ['class'=>'form-control', 'id'=>'year'])?>
                </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                    <label><?= Yii::t('view','Select Month')?></label>
                    <?= Html::dropDownList("month", '', $itemMonth, ['class'=>'form-control', 'id'=>'month'])?>
                </div> 
            </div>
            <div class="col-md-4">
               <div>
                   <label><?= Yii::t('view','View Chart')?></label>
                   <button class="btn btn-primary btn-block" id="btnView"><?= Yii::t('view','Preview')?></button>
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header"></div>
    <div class="box-body">
        <div id="preview-count"></div>
    </div>
</div>
<?php                    richardfan\widget\JSRegister::begin();?>
<script>
    $('#btnView').on('click',function(){
       let year = $('#year').val();
       let month = $('#month').val();
       let params = {year:year, month:month, print:0};
       let url = '/viewcountermanagement/view-count/preview';
       $.get(url, params, function(data){
           $('#preview-count').html(data);
       });
       return false;
    });
</script>
<?php                    richardfan\widget\JSRegister::end();?>