
<?php

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;

    $url = "/sections/content-management/view-file?content_id={$model->content_id}&file_id={$model['id']}&filet_id={$model['file_type']}";//"/sections/section?id={$model['id']}";
    $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org'], 20);
    $noImage = "data:image/png;base64,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";
    $video = "data:image/png;base64,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";
    $image = "{$model['file_path']}/thumbnail/{$model['file_view']}";
?>
 
    <div class="single-product">
        <a href="<?= $url ?>"> 
            <div class="pro-img">
                <?php
                if ($model['file_type'] == 2) {
                    echo Html::img("{$image}", ['class' => 'primary-img img img-responsive', 'alt' => "{$model['file_name_org']}"]);
                } else if ($model['file_type'] == 3) {
                    $imgs = "{$model['file_path']}/{$model['file_name']}_.jpg";
                    echo Html::img($imgs, ['class' => 'img img-responsive']); 
                } else if ($model['file_type'] == 4) {

                    echo "<div style='font-size: 80pt;text-align: center;padding-top: 15px;'><i class='fa fa-music'></i></div>";
                } else if ($model['file_type'] == 5 || $model['file_type'] == 6 || $model['file_type'] == 7) {
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
                    } else {
                        $icon = "<i class='fa fa-file-archive-o'></i>";
                    }
                    echo "<div style='font-size: 80pt;text-align: center;padding-top: 15px;'>{$icon}</div>";
                }
                ?>

            </div> 
            <div class="pro-content">
                <div class="pro-infos">
                    <h2 title='<?= $model['file_name_org'] ?>'> <?= $name_str ?></h2>
<?php
$name_str = backend\modules\sections\classes\JFiles::lengthName($model['details'], 50);
?>
                    <p title="<?= $model['details'] ?>"><?= $name_str ?></p>
                </div>

            </div>
        </a>
    </div>

<?php \appxq\sdii\widgets\CSSRegister::begin() ?>
    <style>
        .pro-img img { 

        }
        a, button, a:before {
            color:#1a1a1b;
        }
    </style>
<?php \appxq\sdii\widgets\CSSRegister::end() ?> 