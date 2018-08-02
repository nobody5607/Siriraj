<div class="row">
    <div class="col-md-8">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-6 col-md-offset-3">
                <img class="img img-responsive img-rounded" src="/images/<?= $dataDefault['file_name_org']?>" style="width:1024px;">
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
                return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-2 col-sm-4 col-xs-6'];
            },
            'layout' => "{pager}\n{items}\n",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_item', ['model' => $model]);
            },
        ]);
        ?>
        <div class="clearfix"></div>
        <?php if(!Yii::$app->user->isGuest){?>
        <div class="btnCart text-center" style="margin-top:50px;margin-bottom:50px;">
            <button class="btn btn-success">เลือกลงตะกร้า</button>
        </div>
        <?php }?>
    </div>
    <div class="col-md-4">
        <label>คำอธิบาย</label>
        <div>
            <small><?= $dataDefault['description']?></small>
        </div><hr/>
        <div>
            <label>ภาพโดย : </label> <small><?= \common\modules\cores\User::getProfileNameByUserId($dataDefault['user_create'])?></small>
        </div><hr/>
        <div>
            <label>ขนาด</label>
            <?php
                use yii\helpers\Html;

                $name = "radiotest";
                $items = [
                    1 => "Extra small  590 x 338px. (7.07x4.69 in.) 72 dpi/0.2 MP", 
                    2 => "Small  728 x 484 px. (7.09x4.71 in.) 72 dpi/0.4 MP ", 
                    3 => "Medium 2124 x 1414 px. (10.11x6.72 in.) 72 dpi/0.4 MP ", 
                    4 => "Large  6162 x 4097 px. (20.54x13.66 in.) 300 dpi/25.2 MP " ];
                $selection = 1;

                echo Html::radioList($name, $selection, $items, [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $disabled = false; // replace with whatever check you use for each item
                        return "<div>".Html::radio($name, $checked, [
                            'value' => $value,
                            'label' => Html::encode($label),
                            'disabled' => $disabled,
                        ])."</div>";
                    },
                ]);
            ?>
        </div>
    </div>
</div>
<?php        appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    @media (min-width: 992px)
    {
        .col-md-2 {
            width: 15.666667%;
            background: #fbf8f8;
            margin: 4px;
            border-radius: 3px;
            height: 100px;
            padding-top: 10px;
            padding-left: 25px;
        }
    }
</style>
<?php        appxq\sdii\widgets\CSSRegister::end();?>