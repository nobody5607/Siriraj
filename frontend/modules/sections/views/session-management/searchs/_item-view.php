
<?php 
    use yii\helpers\Html;
    $link_url = "/sections/content-management/view-file?content_id={$model->content_id}&file_id={$model->id}&filet_id={$model->file_type}";
    $meta_text = appxq\sdii\utils\SDUtility::string2Array($model['meta_text']);
    
    $content = \backend\modules\sections\classes\JContent::getContentById($model->content_id);
    $breadcrumb = \backend\modules\sections\classes\JSection::getBreadcrumb($content['section_id']);
    
    $breadcrumb[] = ['label' => $content['name'], 'url' => ['/sections/section/content-management?content_id='.$content['id']]];
    //$mb = round(($meta_text['size']/1024)/1024);
    $size = \appxq\sdii\utils\SDUtility::convertToReadableSize($meta_text['size']);
    $fileType = explode('.', $model->file_name);
    $fileType = end($fileType);
    //appxq\sdii\utils\VarDumper::dump(end($fileType));
    $meta_file = "<div class='label label-default'>
                      <label>".Yii::t('section', 'Type')." : {$fileType}</label> &nbsp;&nbsp;
                      <label>".Yii::t('section', 'Size')." : {$size}</label>
                  </div>";
    $meta_file=""; 
    $details = backend\modules\sections\classes\JFiles::lengthName($model['details'], 200);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="box-title"><?= $model->file_name_org?></h3> 
    </div>
    <!-- /.box-header -->
    <div class="panel-body" style="">
        <?php echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]); ?>
        <?php if($model->file_type == "2"):?>
        <a href="<?= $link_url?>" target="_blank">
            <div class="media">
                <div class="media-left">
                  <?= Html::img("{$model['file_path']}/thumbnail/{$model['file_name']}", 
                            [
                                'class'=>'media-object',
                                'style'=>'width:150px;border-radius:3px;'
                            ]);?>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?= $model['file_name_org']?></h4>
                  <p><?= backend\modules\sections\classes\JFiles::lengthName($model->details, 150);?></p>  
                  <?= $meta_file?>
                </div>
                
            </div>
        </a>    
        <?php endif; ?>
        <?php if($model->file_type == "3"):?>
        <a href="<?= $link_url?>" target="_blank">
            <div class="media">
                <div class="media-left">
                    <?php 
                        $imgs = "{$model['file_path']}/{$model['file_name']}_.jpg";
                        echo Html::img($imgs,['style'=>'width:200px;border-radius:3px;']);
                    ?>
                    
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?= $model['file_name_org']?></h4>
                  <?= $details?>
                </div>  
            </div>
        </a>    
        <?php endif; ?>
        
        <?php 
             $fileTypeArr = ['4','5','6','7','8'];
             //$fileAudio = ['mp3', ''];
             if(in_array($model['file_type'], $fileTypeArr)){
                $fileNameStr = explode(".", $model['file_name']);
                $icon = "";
                if ($fileNameStr[1] == 'doc' || $fileNameStr[1] == 'docx') {
                    $icon = "<i class='fa fa-file-word-o'></i>";
                } else if ($fileNameStr[1] == 'ppt' || $fileNameStr[1] == 'pptx') {
                    $icon = "<i class='fa fa-file-powerpoint-o'></i>";
                } else if ($fileNameStr[1] == 'xls' || $fileNameStr[1] == 'xlsx') {
                    $icon = "<i class='fa fa-file-excel-o'></i>";
                } else if ($fileNameStr[1] == 'pdf') {
                    $icon = "<i class='fa fa-file-pdf-o'></i>";
                } else if ($fileNameStr[1] == 'zip' || $fileNameStr[1] == 'rar') {
                    $icon = "<i class='fa fa-file-pdf-o'></i>";
                } else if ($model['file_type'] == "4") {
                    $icon = "<i class='fa fa-file-audio-o'></i>";
                }
                else {
                    $icon = "<i class='fa fa-file-archive-o'></i>";
                }
                
                //echo "<div style='font-size: 80pt;text-align: center;padding-top: 15px;'>{$icon}</div>";
                echo "
                  <a href='{$link_url}' target='_blank' style='color:#000'>
                        <div class='media'>
                            <div class='media-left' style='font-size:90px;'>
                                {$icon}
                            </div>
                            <div class='media-body'>
                              <h2 class='media-heading'>{$model['file_name_org']}</h2>
                              {$details}
                            </div>  
                        </div>
                    </a>
                ";
            }
        ?>
    </div> 
</div>