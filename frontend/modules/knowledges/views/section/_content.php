<?php 
    $folderImage = Yii::getAlias('@storageUrl/avatars/folder.png');
?>
<div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <img class="img" src="<?= $folderImage?>" alt="User Image">
                <span class="username"><a href="#"><?= $model['name']?></a></span>
                <span class="description"><i class="fa fa-calendar"></i> <?= \appxq\sdii\utils\SDdate::mysql2phpDate($model['create_date'])?></span>
            </div>
            <!-- /.user-block -->
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                    <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $model['description']?>
            <!-- Attachment -->
             
            <!-- Social sharing buttons -->
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
        </div>
        <!-- /.box-body -->

        <!-- /.box-footer -->

        <!-- /.box-footer -->
    </div>