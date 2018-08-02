<?php 
    //$this->title= Yii::t('section',$title);    
    if($breadcrumb){
       foreach($breadcrumb as $b){
        $this->params['breadcrumbs'][] = $b;  
      } 
    }
?>
<div class="box box-primary">
    <div class="box-body">
         <?= $this->render('view-file/view',[
             'dataProvider'=>$dataProvider,
             'dataDefault'=>$dataDefault
         ]);?>
    </div>
</div>