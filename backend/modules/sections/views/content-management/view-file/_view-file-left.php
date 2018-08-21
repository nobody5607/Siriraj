<?php 
    use yii\helpers\Html;
//    \appxq\sdii\utils\VarDumper::dump($dataProvider);
?>
<div class="col-md-8 view-file-left">
    <div class="box box-primary">
        <div class="box-header">
            <?php //appxq\sdii\utils\VarDumper::dump($dataDefault);?>
            <h4><?php//$dataDefault['name'] ?></h4>
        </div> 
        <div class="box-body">
            <span class="pull-right">
                            <?php
                                echo Html::button("<i class='fa fa-plus'></i>", [
                                    'data-id' => $dataDefault['file_type'],
                                    'data-parent_id' => Yii::$app->request->get('id', '0'),
                                    'file_type'=>Yii::$app->request->get('filet_id', '0'),
                                    'data-action' => 'create',
                                    'class' => 'btn btn-success btnCreateFile',
                                    'title' => Yii::t('appmenu', 'Create'),
                                    'data-url' => '/sections/session-management/create'
                                ]);
                            ?> 
                        </span>
            <div class="row" style="margin-bottom:10px;">
                <div class="col-md-6 col-md-offset-3">
                    <?php 
                        if($dataDefault['file_type'] == '2'){
                            echo yii\helpers\Html::img("{$dataDefault['file_path']}/{$dataDefault['file_name']}", ['class'=>'img img-responsive','style'=>"width:1024px;"]);
                        }elseif ($dataDefault['file_type'] == 3) {
                            echo"
                                <video style='width:100%' controls>
                                    <source src='/videos/{$dataDefault['file_name_org']}' type='video/mp4'>                 
                                    Your browser does not support the video tag.
                                </video>
                            ";
                        }
                    ?>
 
                </div>
            </div>
            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-12',
                    'id' => 'file_types',
                ],
                'itemOptions' => function($model) {
                    return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-2 col-sm-4 col-xs-6','style'=>'margin-bottom:80px;height: 80px;'];
                },
                'layout' => "{pager}\n{items}\n",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_item', ['model' => $model]);
                },
            ]);
            ?>
            <div class="clearfix"></div>
            
        </div>
    </div>
</div>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
     
    .view-file-left{
        border-right: 1px solid #ecf0f5;
    } 
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>

<?php 
    $modal = "modal-contents";
?>
<?php \richardfan\widget\JSRegister::begin(); ?>
    <script>
        $('.btnCreateFile').on('click', function(){
            let id = $(this).attr('data-id');
            let content_id = '<?= Yii::$app->request->get('content_id', '')?>';
            $('#<?= $modal?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
            $('#<?= $modal?>').modal('show');
            let url = '/sections/file-management/upload-file';
            let file_type = $(this).attr('file_type');
            $.get(url,{id:id,file_type:file_type,content_id:content_id}, function(res){
                $('#<?= $modal?> .modal-content').html(res);
            });
           return false;
        });
    </script>
<?php \richardfan\widget\JSRegister::end(); ?>