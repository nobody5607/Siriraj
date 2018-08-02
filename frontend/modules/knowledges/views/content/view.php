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
        <div class="row">
            <?php foreach ($file_type as $key=> $f):?>
                <?php if($key > 0):?>
                    <div class="col-md-12">
                        <h4><i class="fa <?= $f['icon']?>"></i> <?= $f['name']?></h4><hr/>
                        <div id="files_<?= $f['id']?>" data-id='<?= $f['id']?>'>x</div>
                        <a href="#">ดูทั้งหมด</a>
                        <?php \richardfan\widget\JSRegister::begin();?>
                        <script>
                            loadData=function(){
                                let url = '/knowledges/content/get-data'
                                let content_id = "<?= Yii::$app->request->get('content_id')?>";
                                let select_id = "files_<?= $f['id']?>";

                                let params = {content_id:content_id, type_id:"<?= $f['id']?>"};
                                $.get(url, params, function(data){
                                    $('#'+select_id).html(data);
                                });
                            }
                            loadData();
                        </script>
                        <?php \richardfan\widget\JSRegister::end();?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
       <?php 
        
//            echo TabsX::widget([
//                'items'=>$items,
//                'position'=>TabsX::POS_ABOVE,
//                'encodeLabels'=>false,
//                'options'=>['id'=>'templates']
//            ]);
       ?>
    </div>
</div> 
<?php 
    $this->registerJs("
        $('#templates .active a').trigger('click');
    ");
?>