<?php     
    use yii\bootstrap\Html;    
    \janpan\jn\assets\ListdataAsset::register($this);
    \janpan\jn\assets\EzfToolAsset::register($this);
    $this->title= Yii::t('section',$title);    
    if($breadcrumb){
       foreach($breadcrumb as $b){
        $this->params['breadcrumbs'][] = $b;  
      } 
    }else{
       // $this->params['breadcrumbs'][]=$this->title;
    }
    $data_id = isset($_GET['id']) ? $_GET['id'] : $content_section['id'];
    $section_obj = \common\models\Sections::findOne($data_id);  
?>  
 <section id="items-side" class="items-sidebar navbar-collapse collapse" role="complementary" >
    <div id="items-side-scroll" class="row">
        <div class="col-lg-12">
            <div class=" sidebar-nav-title" >
                <?php if(!isset($_GET['id'])):?>
                    <?= \yii\helpers\Html::img('/images/1533128627373.jpg', ['class' => 'img img-responsive', 'style'=>'width:100%']) ?>
                <?php else:?>
                <div class="container" style="padding-top: 10px;">                     
                    <h4><?= "<i class='fa {$section_obj['icon']}'></i> {$section_obj['name']}"?></h4>                     
                </div>
                <?php endif; ?>
                 
            </div>
            <?php // $this->render('_search', ['model' => $searchModel]);  ?>
            <div>
                 <?= $this->render('left-content',[
                    'dataProvider'=>$dataProvider, 
                    'data_id'=> isset($_GET['id']) ? $_GET['id'] : $content_section['id'], 
                ]);?>
            </div>
        </div>
    </div>
</section>
<section id="items-views" role="complementary" >
    <div class="row"> 
        <?php
            echo $this->render('right-content',[
                'contentProvider'=>$contentProvider, 
                'data_id'=> $data_id, 
                'parent_id'=>$content_section['id'],
                'public'=>$public,
                'content_section'=>$content_section]
        );?>    
    </div>
    
</section>
    
    
 
 

<?php 
    $modal = "modal-contents";
?>
<?php \richardfan\widget\JSRegister::begin();?>

<script>
   $('.btnCall').on('click', function(){
       let id       = $(this).attr('data-id');
       let url      = $(this).attr('data-url');
       let action   = $(this).attr('data-action');
       let parent_id = $(this).attr('data-parent_id'); 
       let params   = {id:id, parent_id:parent_id};
       if(action == 'delete'){
           delete_form(url , id);
       }else{
           get_form(url , params); 
       }      
       return false; 
   });
   get_form=function(url , params){
       $('#<?= $modal?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
       $('#<?= $modal?>').modal('show');
       $.get(url, params, function(res){
           $('#<?= $modal?> .modal-content').html(res);
       });
   } 
   delete_form=function(url, id){
        yii.confirm('<?= Yii::t('user', 'Confirm Delete?') ?>', function(){
            $.post(url, {id:id}, function(result){
                <?= appxq\sdii\helpers\SDNoty::show('result.message', 'result.status') ?>
                setTimeout(function(){
                    location.reload();
                },1000);
            });
        });   
    return false;
   }

   
</script>
<?php \richardfan\widget\JSRegister::end();?>

<?php 
    if(!$data_id){
        //appxq\sdii\utils\VarDumper::dump($data_id);
        $this->registerCss("
            @media (min-width: 768px){
                #items-views {                    
                    margin-top:-25px;
               } 
            }
        ");
    }else{
        //appxq\sdii\utils\VarDumper::dump($data_id);
        $this->registerCss("            
            .content-header>.breadcrumb{
                right: 12px;
                left: 361px;
                top: 60px;
                box-shadow:none;
                padding: 8px 15px;
                margin-bottom: 20px;
                list-style: none;
                border-radius: 4px;
                border: 1px solid #e7e7e7; 
                font-size: 12pt;
                background-color: #f8f8f8;
                float: none;
            }
            @media screen and (max-width: 768px){
                .content-header>.breadcrumb{
                    left: 0px;
                }
            }
        ");
    }
?>
<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .box.box-primary {
        border: none;
        box-shadow: 0px 0px 1px #cacaca;
    }
    @media (min-width: 768px){
       #items-views {
            margin-left: 350px;            
       } 
    }
    
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>

