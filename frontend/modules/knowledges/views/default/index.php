<?php

use yii\helpers\Html;
$this->title = $title_arr['title'];
foreach($breadcrumbs as $b){
  $this->params['breadcrumbs'][] = $b;  
}
?>
<div class="row">
    <div class="col-md-4" id="left-menu">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <a href="<?= $title_arr['url'] ?>" style="    font-size: 16pt;">
                        <i style="font-size: 12pt;" class="<?= $title_arr['icon'] ?>"></i>
                        <span class="text"><?= $title_arr['name'] ?></span>
                    </a> 
                </div>
            </div>
            <div class="panel-body scrollbar-macosx left-fiex">
                <?= 
                    \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => [
                            'tag' => 'div',
                            'class' => 'list-section',
                            'id' => 'list-section',
                        ],
                        'itemOptions'=>function($model){
                            return ['data-id'=>$model['id'] , 'class'=>'list-section-items'];
                        },
                        'layout' => "{pager}\n{items}\n",
                        'itemView' => function ($model, $key, $index, $widget) {         
                            return $this->render('_list_item',['model' => $model]);
                        },
                    ]); 
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-8" id="right-menu">
        <?= $this->render("_content", ['dataProviderContent'=>$dataProviderContent, 'title_arr'=>$title_arr])?>   
    </div>
</div>
<?php
$this->registerJS("
    $('.scrollbar-macosx').scrollbar();
");
$this->registerCss("
       
      
      a:link{text-decoration:none;}  
      #list-section{
        display:flex;
        flex-direction: column;
        padding:3px;
      }
      #list-section .list-section-items{
        padding: 10px;
      }
      #list-section .list-section-items:hover{
        background: #c6e4c0;
        border-radius: 3px;
            
      }
      #list-section .list-section-items a{
        color:#6d6d6d;
        text-decoration:none;
//        color: #789a32;
      }
      .breadcrumb li a{
        text-decoration:none;
      }
      

");
?>