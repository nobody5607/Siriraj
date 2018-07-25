<?php
    $this->title= Yii::t('section','ห้องความรู้');
    $this->params['breadcrumbs'][] = $this->title;
?> 

<div class="row">
    <div class="col-md-3">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
                 <h3 class="widget-user-username"><i class="fa fa-home"></i> ห้องความรู้</h3>
            </div>
            <div class="box-footer no-padding">
                <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => [
                            'tag' => 'ul',
                            'class' => 'nav nav-stacked',
                            'id' => 'section-all',
                        ],
                        'itemOptions' => function($model) {
                            return ['tag'=>'li','data-id' => $model['id'], 'class' => 'section-items'];
                        },
                        'layout' => "{pager}\n{items}\n",
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_item', ['model' => $model]);
                        },
                    ]);?>            
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <div class="col-md-9">
        <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $contentProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'content-list',
                'id' => 'section-all',
            ],
            'itemOptions' => function($model) {
                return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'box box-widget'];
            },
            'layout' => "{pager}\n{items}\n",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_content', ['model' => $model]);
            },
        ]);
        ?>      
    </div>
</div>
 <?php\appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .widget-user-2 .widget-user-header {
        padding: 5px;
    }
    .widget-user-2 .widget-user-username, .widget-user-2 .widget-user-desc {
        margin-left: 15px;
    }
    .widget-user-2 .widget-user-username {
        font-size: 14pt;
    }
</style>
<?php\appxq\sdii\widgets\CSSRegister::end();?>