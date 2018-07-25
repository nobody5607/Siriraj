<?php
    use yii\helpers\Html;
  
    $this->title = $title_arr['title'];
    foreach($breadcrumbs as $b){
      $this->params['breadcrumbs'][] = $b;  
    }
?>

<div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-md-3 col-xl-3 bd-sidebar">
            
            <?= 
                    \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => [
                            'tag' => 'nav',
                            'class' => 'bd-links collapse show',
                            'id' => 'bd-docs-nav',
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
        <!-- /#sidebar-wrapper -->
        
        <!-- Page Content -->
        <div class="col-12 col-md-9 col-xl-9 py-md-3 pl-md-5 bd-content" role="main">
            <?= $this->render("_content", ['dataProviderContent'=>$dataProviderContent, 'title_arr'=>$title_arr])?>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
  
 <?php 
     
    $this->registerJS("   
        $('#wrapper').toggleClass('toggled');
        $('#menu-toggle').click(function(e) {
            e.preventDefault();
            $('#wrapper').toggleClass('toggled');
        });
        
    ");
 ?>
<?php 
$this->registerCss("
    .bd-toc-link {
        display: block;
        padding: .25rem 1.5rem;
        font-weight: 500;
        color: rgba(0,0,0,.65);
    }
    .bd-sidebar .nav>.active:hover>a, .bd-sidebar .nav>.active>a {
        font-weight: 500;
        color: rgba(0,0,0,.85);
        background-color: transparent;
    }
    .bd-sidebar .nav>li>a {
        display: block;
        padding: .25rem 1.5rem;
        font-size: 90%;
        color: rgba(0,0,0,.65);
    }
    @media (min-width: 768px)
    {
        .bd-links {
            display: block!important;
        }
    }
    @media (min-width: 768px)
    {
        .bd-links {
            max-height: calc(100vh - 9rem);
            overflow-y: auto;
        }
    }
    .bd-links {
        padding-top: 1rem;
        padding-bottom: 1rem;
        margin-right: -15px;
        margin-left: -15px;
        margin-top: 25px;
    }
    
    .bd-sidebar {
        -webkit-box-ordinal-group: 1;
        -ms-flex-order: 0;
        order: 0;
        border-bottom: 1px solid rgba(0,0,0,.1);
    } 
    
/*search */
.bd-search {
    position: relative;
    padding: 1rem 15px;
    margin-right: -15px;
    margin-left: -15px;
    border-bottom: 1px solid rgba(0,0,0,.05);
}
.align-items-center {
    -webkit-box-align: center!important;
    -ms-flex-align: center!important;
    align-items: center!important;
}
.algolia-autocomplete {
    display: block!important;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
}

/*block*/
 .collapse.show {
    display: block;
}
.bd-toc-item.active>.bd-toc-link {
    color: rgba(0,0,0,.85);
}

.bd-toc-link {
    display: block;
    padding: .25rem 1.5rem;
    font-weight: 500;
    color: rgba(0,0,0,.65);
}
a:link{text-decoration:none;}
");
?>