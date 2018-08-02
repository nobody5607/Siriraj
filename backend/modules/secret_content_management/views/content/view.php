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
                        <h4>
                            <i class="fa <?= $f['icon']?>"></i> <?= $f['name']?>
                            
                        </h4>
                        <small id="label_<?= $f['id']?>">ภาพ</small>
                        <hr/>
                        
                        <div id="files_<?= $f['id']?>" data-id='<?= $f['id']?>'></div>
                        
                        <div class="text-center">
                            <a href="/knowledges/content/view-content-data?content_id=<?= $_GET['content_id']?>&file_id=1&filet_id=<?= $f['id']?>" ><< ดูทั้งหมด >></a>
                        </div>
                        
                        <?php \richardfan\widget\JSRegister::begin();?>
                        <script>
                            loadData=function(){
                                let url = '/content_management/content/get-data'
                                let content_id = "<?= Yii::$app->request->get('content_id')?>";
                                let select_id = "files_<?= $f['id']?>";

                                let params = {content_id:content_id, type_id:"<?= $f['id']?>"};
                                $.get(url, params, function(data){
                                    $('#'+select_id).html(data);                                    
                                });
                                return false;
                                
                            }
                            loadCountData=function(){
                                let url = '/content_management/content/get-count-data'
                                let content_id = "<?= Yii::$app->request->get('content_id')?>";
                                let select_id = "label_<?= $f['id']?>";

                                let params = {content_id:content_id, type_id:"<?= $f['id']?>"};
                                $.get(url, params, function(data){
                                    $('#'+select_id).html(data);                                    
                                });
                                return false;
                                
                            }                             
                            loadCountData();                             
                            loadData();
                        </script>
                        <?php \richardfan\widget\JSRegister::end();?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
 
    </div>
</div> 

 