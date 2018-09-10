<?php 
    $type = frontend\modules\sections\classes\JFiles::getTypeFile();
    //\appxq\sdii\utils\VarDumper::dump($type);
?>
<div class="container">
    <div class="row align-items-center no-gutters">
            <div class="col-lg-1 col-md-12">
                <div class="logo mb-all-30">
                    <a href="/"><img src="/images/logosirirajweb3.png" alt="logo-image"></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="logo mb-all-30">
                    <a href="/"> <img src="/images/1533128627373.jpg"></a>
                </div>
            </div>           
            
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php echo $this->render("_nav_right")?> 
            <?php endif; ?>
            
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div> 

<div style="margin-top: 10px;background:#cea967; height: 115px;padding-top: 30px;">
    <div class="col-md-8 col-md-offset-2">
        <?= $this->render("_form", ['type' => $type]) ?>     
    </div>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <!-- Cart Box End Here -->
</div> 
<?php 
   $controllerID = Yii::$app->controller->id ;
   $actionID = Yii::$app->controller->action->id;
   //\appxq\sdii\utils\VarDumper::dump($actionID);
?>
<?php    richardfan\widget\JSRegister::begin(); ?>
<script>
    var select_type_search=0;
    $('#select-type-search').on('change', function(){
       let value = $(this).val();
       select_type_search = value;        
    });
    $('#formSearch').on('submit', function(){
        let type_id = select_type_search;
        let txtsearch = $('#text_search_params').val();
        let params = {type_id:type_id, txtsearch:txtsearch};
        //console.log(params);return false;
        let url = "/sections/session-management/search?type_id="+type_id+"&txtsearch="+txtsearch;
        let actionID = "<?= $actionID?>";
        
        if(actionID == "search"){
           window.open(url,'_parent');
        }else{
            window.open(url,'_blank');  
        }
       
        //location.href = url;
        
        return false;
    });
    $('.select_type').on('click', function(){
        let id = $(this).attr('data-id');
        $('#search_param').val(id);
       
    });
    
</script>
<?php    richardfan\widget\JSRegister::end();?>