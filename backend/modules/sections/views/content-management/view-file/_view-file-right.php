<?php 
    use yii\helpers\Html;
?>
<div class="col-md-4 view-file-right">
    <div class="box box-primary">
        <div class="box-body">
            <label>
        <i class="fa fa-info-circle" aria-hidden="true"></i> คำอธิบาย
    </label>
    <div class="border-bottom">
        <small><?= $dataDefault['description'] ?></small>
    </div>     
    <div class="border-bottom">
        <label>
            <i class="fa fa-user" aria-hidden="true"></i> ภาพโดย : <?= \common\modules\cores\User::getProfileNameByUserId($dataDefault['user_create']) ?> s
        </label>    
    </div>
     
    <div>
        <label>ขนาด</label>
        <?php 

        $name = "radiotest";
        $items = [
            1 => "Extra small  590 x 338px. (7.07x4.69 in.) 72 dpi/0.2 MP",
            2 => "Small  728 x 484 px. (7.09x4.71 in.) 72 dpi/0.4 MP ",
            3 => "Medium 2124 x 1414 px. (10.11x6.72 in.) 72 dpi/0.4 MP ",
            4 => "Large  6162 x 4097 px. (20.54x13.66 in.) 300 dpi/25.2 MP "];
        $selection = 1;

        echo Html::radioList($name, $selection, $items, [
            'item' => function ($index, $label, $name, $checked, $value) {
                $disabled = false; // replace with whatever check you use for each item
                return "<div>" . Html::radio($name, $checked, [
                            'value' => $value,
                            'label' => Html::encode($label),
                            'disabled' => $disabled,
                        ]) . "</div>";
            },
        ]);
        ?>
    </div>
        </div>
    </div>
</div>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
   .view-file-right{      
     padding:5px;   
   }
   .border-bottom{
        border-bottom: 1px solid #ecf0f5;
        border-bottom-style: dashed;
        padding-bottom: 10px;
        padding-top: 10px;
   }
</style>
<?php appxq\sdii\widgets\CSSRegister::end();?>