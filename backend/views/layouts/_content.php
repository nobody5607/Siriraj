<?php

use yii\bootstrap\Html;
use yii\helpers\Inflector;
use yii\widgets\Breadcrumbs;
use lo\modules\noty\Wrapper;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo Html::encode($this->title);    
                } else {
                    echo Inflector::camel2words(Inflector::id2camel($this->context->module->id));
                    echo ($this->context->module->id !== Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
    </section>

    <section class="content">
        <?= Wrapper::widget() ?>
        <div > 
           <div>
               <?php appxq\sdii\widgets\CSSRegister::begin();?>
               <style>
                   .modal-lg{width: 90%;}
                   .content-header>.breadcrumb{font-size:12pt;}
                   .box .box-default {
                        border: none;
                        box-shadow: 0px 0px 1px #cacaca;
                    }
               </style>
               <?php appxq\sdii\widgets\CSSRegister::end();?>
               <?php 
                    echo appxq\sdii\widgets\ModalForm::widget([
                        'id' => 'modal-contents',
                        'size'=>'modal-lg',
                        'options'=>['tabindex' => false]
                    ]);
               ?>
                <?= $content ?>
            </div>
        </div>
    </section>
</div>
 