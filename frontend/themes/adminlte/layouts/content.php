<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content-header" style="margin-bottom:15px;">
        <?=
            Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            ) ?>         
    </section>
    <?php appxq\sdii\widgets\CSSRegister::begin();?>
    <style>
        .content-header>.breadcrumb>li+li:before {
            content: '/\00a0';
            color: #504d4d;
        }
    </style>
    <?php appxq\sdii\widgets\CSSRegister::end();?>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
 