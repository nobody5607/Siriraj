 <?php
    use yii\bootstrap\Html;
    use kartik\tabs\TabsX;
    $this->title= Yii::t('section',$title);    
    if($breadcrumb){
       foreach($breadcrumb as $b){
        $this->params['breadcrumbs'][] = $b;  
      } 
    } 
?>

<div class="box box-primary">
    <div class="box-body">
       <?php              
            echo TabsX::widget([
                'items'=>$items,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'options'=>['id'=>'templates']
            ]);
       ?>
    </div>
</div> 
<?php 
    $this->registerJs("
        $('#templates .active a').trigger('click');
    ");
?>