<?php 
    $folderImage = Yii::getAlias('@storageUrl/avatars/folder.png');
?>
<div class="box-widget">
        <div class="box-header with-border">
            
            <div class="user-block">                  
                <span class="username" style="display:flex;">
                    
                    <a href="#" style="flex-grow: 2;">
                        <?= $model['name'] ?>                         
                    </a>
                    <span class="description">
                            <i class="fa fa-calendar"><?= \appxq\sdii\utils\SDdate::mysql2phpDate($model['create_date']) ?></i> 
                    </span>
                </span>

            </div>
        </div>
       
    </div>