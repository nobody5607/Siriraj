<?php 
    use yii\helpers\Html;
?>
<div class="trendig-product pb-10 off-white-bg" id="row-<?= $f['id'] ?>"> 
    <div class="container-fluid">
        <div class="trending-box">            
            <div class="product-list-box">                  

                <h3 class="text-left header-text-content" style="">
                    <i class="fa fa-<?= $f['icon'] ?>"> <?= Yii::t('section',$f['name']) ?> </i>                         
                    <small ><?= count($files) ?> <?= Yii::t('section', 'Item') ?> </small>

                </h3>
                <div class="row" >
                    <?php foreach ($files as $key => $file): ?>
                        <div class="col-md-3 col-xs-6">
                            <?=
                            $this->render('_item_file', [
                                'model' => $file
                            ]);
                            ?>
                        </div>    
                    <?php endforeach; ?>
                    <?php appxq\sdii\widgets\CSSRegister::begin()?>
                    <style>
                        .header-text-content{
                            padding: 10px;  
                            text-align: left; 
                            background: #57a19f; 
                            border-top-left-radius: 3px;
                            border-top-right-radius: 3px;
                        }
                        .header-text-content small, .header-text-content i{ color:#2e5857;font-size: 14pt; } 
                        .single-product{
                            background:#fff;
                            height:300px;
                            padding:5px;
                            border-radius: 3px;
                            box-shadow: 1px 1px 1px #a5cdcc;
                            margin-bottom: 10px;
                        }
                        .single-product .pro-img{
                            width:99%;
                            margin:0 auto;
                            text-align: center;
                        }
                        .pro-img img {
                            /* text-align: center; */
                            margin: 0 auto;
                            height: 100%;
                        }
                        .pro-content .pro-infos h2{
                            font-size:14pt;
                            text-align: center;
                            overflow: hidden;
                            
                        }
                        .pro-img{
                            height:180px;overflow:hidden;
                        }
                        a:hover{text-decoration: none;}
                        /* mobild */
                        @media screen and (max-width:768px){
                            .single-product .pro-img {
                                /* width: 99%; */
                                margin: 0 auto;
                                text-align: center;
                                height: 100px;
                            }
                            .pro-content .pro-infos h2{
                                font-size:10pt;
                                text-align: center;
                            }
                            .pro-img{
                                height: auto;
                            }
                            .single-product{
                                /*height: 170px;*/
                                height:auto;
                            }
                            .pro-img img {
                                /* text-align: center; */
                                margin: 0 auto;
                                height: 100%;
                            }
                            .pro-content .pro-infos p{
                                display: none;
                            }
                        }
                    </style>
                    <?php appxq\sdii\widgets\CSSRegister::end();?>
                </div>  

                <div class="row" style="margin-top:10px;">
                        <div class="col-md-6 col-md-offset-3">
                            <?=
                                Html::a(Yii::t('section', 'more...'), "/sections/content-management/view-file?content_id={$content_id}&file_id=&filet_id={$f['id']}", [
                                    'id' => "btn-{$f['id']}",
                                    'data-action' => 'view-file',
                                    'class' => 'content-popup btnCall text-center btn btn-success btn-lg btn-block',
                                    'data-id' => $f['id'],
                                    'style' => 'color:#fff;'
                                ]);
                                ?>
                        </div>
                    </div>

            </div>
            <!-- main-product-tab-area-->
        </div>
    </div>
    <!-- Container End -->
</div> 
 