<?php 
    use yii\helpers\Html;
    $link_url = "/sections/content-management/view-file?content_id={$model->content_id}&file_id={$model->id}&filet_id={$model->file_type}";
    $meta_text = appxq\sdii\utils\SDUtility::string2Array($model['meta_text']);
    
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $model->file_name_org?></h3>                 
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
        <?php if($model->file_type == "2"):?>
        <a href="<?= $link_url?>" target="_blank">
            <div class="media">
                <div class="media-left">
                  <?= Html::img("{$model['file_path']}/thumbnail/{$model['file_name']}", 
                            [
                                'class'=>'media-object',
                                'style'=>'width:60px'
                            ]);?>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?= $model['file_name_org']?></h4>
                  <p><?= $model['meta_text']?></p>
                </div>
            </div>
        </a>    
        <?php endif; ?>
        <?php if($model->file_type == "3"):?>
        <a href="<?= $link_url?>" target="_blank">
            <div class="media">
                <div class="media-left">
                    <video style='width:95px' class="media-object" controls>
                    <source src='<?php echo "{$model['file_path']}/{$model['file_name']}"; ?>' type='video/mp4'>                 
                        Your browser does not support the video tag.
                  </video>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?= $model['file_name_org']?></h4>
                  <div>
                      <label><?= Yii::t('file', 'Type')?>: </label>
                  </div>
                </div>
            </div>
        </a>    
        <?php endif; ?>
    </div> 
</div>