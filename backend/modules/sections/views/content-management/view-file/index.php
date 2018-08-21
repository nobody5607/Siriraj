<?php

use yii\bootstrap\Html;
use kartik\tabs\TabsX;

$this->title = Yii::t('section', $title);
if ($breadcrumb) {
    foreach ($breadcrumb as $b) {
        $this->params['breadcrumbs'][] = $b;
    }
}
$modal = "modal-contents";
?>


<div class="row">
    <?= $this->render('_view-file-left', ['dataProvider' => $dataProvider, 'dataDefault' => $dataDefault]) ?>
    <?= $this->render('_view-file-right', ['dataProvider' => $dataProvider, 'dataDefault' => $dataDefault, 'choice'=>$choice]) ?>

</div>
<?php richardfan\widget\JSRegister::begin();?>
<script>
    $('.btnCall').on('click', function(){
        let action = $(this).attr('data-action');
        let id       = $(this).attr('data-id');
        
        let url      = $(this).attr('data-url');
        if(action == 'delete'){
            yii.confirm('<?= Yii::t('file', 'Confirm Delete?') ?>', function(){
                $.post(url, {id:id}, function(result){                    
                    <?= appxq\sdii\helpers\SDNoty::show('result.message', 'result.status') ?>
                    $('#img-'+id).remove();
//                    setTimeout(function(){
//                        location.reload();
//                    },1000);
                });
            });   
        }
        
        return false;
    });
    
</script>
<?php richardfan\widget\JSRegister::end();?>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    @media (min-width: 992px)
    {
        .col-md-2 {
            width: 15.666667%;            
            margin: 4px;
            border-radius: 3px;
            height: 100px;
            padding-top: 10px;
            padding-left: 25px;
        }
    }
    .box.box-primary {
        border: none;
        box-shadow: 0px 0px 1px #cacaca;
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>