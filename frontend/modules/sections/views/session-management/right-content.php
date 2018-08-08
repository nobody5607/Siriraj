<?php
    use yii\helpers\Html;
    $section_obj = \common\models\Sections::findOne($data_id);   
     
?>
<?php if(!isset($_GET['id'])):?>
<div>
    
    <?php echo $this->render('_searchbar');?>  
</div>
<div class="clearfix" style="margin-bottom:10px;"></div>
<?php endif; ?> 
<div class="col-md-12 section-right">      
    <?php if($public == '1'): ?>
    <div class="box box-primary">
            <?php if (isset($_GET['id'])): ?>
                <div class="box-header">   
                    <h4><?= "<i class='fa {$section_obj['icon']}'></i> {$section_obj['name']}" ?></h4>
                    <div class="row">                     
                        <?= $this->render('_searchbar'); ?>
                    </div>
                </div>            
            <?php else: ?>

            <?php endif; ?>                   
        
        <div class="box-body">            
            <div class="content-data" style="display: flex;flex-direction: column;margin-top:20px;margin-bottom:50px;">                    
                <div style="margin-bottom: -25px;font-size: 12px;">                   
                    
                </div>
                
                <?php if(isset($_GET['id'])):?>
                    <div class="clearfix" style="margin-bottom:30px;"></div>
                <?php else:?>
                    <div class="clearfix" style="margin-bottom:10px;"></div>
                <?php endif; ?>
                <div id="content-html">                    
                    <?= $content_section->content; ?>
                </div> 
            </div>             
        </div>
    </div>
    <?php endif; ?>
     
    <div class="clearfix"></div>
    <div class="box box-primary">
        
        <div class="box-body">
            
            <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $contentProvider,
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'products-list product-list-in-box',
                        'id' => 'section-all',
                        'style'=>'padding: 2px;'
                    ],
                    'itemOptions' => function($model) {
                        return ['tag' => 'li', 'data-id' => $model['id'], 'class' => 'item'];
                    },
                    'layout' => "{items}\n{pager}",
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_right_content_item', ['model' => $model]);
                    },
                ]);
            ?>
        </div>
    </div>

</div>
 
<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .box-comments {
        background: #ffffff;
    }
    @media (min-width: 768px){
        .dl-horizontal dt {
            float: left;
            width: 80px;
            overflow: hidden;
            clear: left;
            text-align: right;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .dl-horizontal dd {
            margin-left: 90px;
        }
    }
.box-body { 
        padding: 0px;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>