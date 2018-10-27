<?php

use yii\bootstrap\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Yii::t('section', ($title != '') ? $title : 'Session Management');

$data_id = isset($_GET['id']) ? $_GET['id'] : $content_section['id'];
$section_obj = \common\models\Sections::findOne($data_id);
$name_str = backend\modules\sections\classes\JFiles::lengthName($section_obj['name'], 18);
?>  

<!--  Image Banner  -->
<div class="image-banner pb-0 off-white-bg">
    <div class="text-center">
        <div class="col-imgs">

            <?php
            if ($breadcrumb) {
                echo janpan\jn\widgets\BreadcrumbsWidget::widget([
                    'breadcrumb' => $breadcrumb
                ]);
            }
            ?>
        </div>
    </div> 
</div>

<div class="trendig-product pb-10 off-white-bg">
    <?php if (count($dataProvider->getModels()) != 0): ?>
        <h2 class="text-center header-section"><?= Yii::t('section', 'Siriraj Museum ... more than you think.') ?> : <?= $title ?></h2>
<?php endif; ?>

    <div class="">
        <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'row',
                //        'id' => 'section-all',
                'id' => 'ezf_dad',
            ],
            'itemOptions' => function($model) {
                return ['tag' => 'div', 'class' => 'col-md-3 col-xs-6', 'data-id' => "{$model['id']}"];
            },
            'emptyText' => false,
            'layout' => "{items}\n<div class='list-pager'>{pager}</div>",
            'itemView' => function ($model, $key, $index, $widget) {

                return $this->render('_item', ['model' => $model, 'key' => $key + 1]);
            },
        ]);
        ?>
<?php richardfan\widget\JSRegister::begin(); ?>
        <script>
            $('.btn-parent').css({cursor: 'pointer'});
            $('.btn-parent').on('click', function () {
                let id = $(this).attr('data-id');
                let url = '/sections/section?id=' + id;
                location.href = url;
            });
        </script>
<?php richardfan\widget\JSRegister::end(); ?>


    </div>
    <!-- Container End -->
</div> 
<?php if (!empty(Yii::$app->request->get("id")) && count($contentProvider->getModels()) != 0): ?>
    <?php ?>
    <div class="trendig-product pb-10 off-white-bg">
        <h2 class="text-center"><?= Yii::t('section', 'Data') ?> : <?= $title ?></h2>
        <div class="">
            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $contentProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'row',
                    //        'id' => 'section-all',
                    'id' => 'ezf_dad',
                ],
                'itemOptions' => function($model) {
                    return ['tag' => 'div', 'class' => 'col-md-3 col-xs-6', 'data-id' => "{$model['id']}"];
                },
                'layout' => "{items}\n<div class='list-pager'>{pager}</div>",
                'itemView' => function ($model, $key, $index, $widget) {

                    return $this->render('_item-content', ['model' => $model, 'key' => $key + 1]);
                },
            ]);
            ?>

            <?php richardfan\widget\JSRegister::begin(); ?>
            <script>
                $('.btn-content').css({cursor: 'pointer'});
                $('.btn-content').on('click', function () {
                    let id = $(this).attr('data-id');
                    let url = '/sections/section/content-management?content_id=' + id;
                    location.href = url;
                });
            </script>
            <?php richardfan\widget\JSRegister::end(); ?>

        </div>
        <!-- Container End -->
    </div>
<?php endif; ?>



<?php appxq\sdii\widgets\CSSRegister::begin() ?>
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
        background: #54a19f29;
        height: 330px;
        padding: 5px;
        border-radius: 3px;
        /*box-shadow: 0px 1px 1px #94c5c2;*/
        margin-bottom: 10px;
        border: 1px solid #a7cecc;
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
        width:100%;
    }
    .pro-content .pro-infos h2{
        font-size:18pt;
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
<?php appxq\sdii\widgets\CSSRegister::end(); ?>