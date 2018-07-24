<?php

use yii\helpers\Html;
?>

<div id="left-sidebar" class="left-sidebar ">
    <div class="sidebar-scroll">

        <nav class="main-nav">
            <ul class="main-menu left-menu" style="margin-bottom: -38px;">
                <li>
                    <a href="<?= $title_arr['url'] ?>" style="background:#d4d4d4;font-size: 10pt;font-family: sans-serif;font-weight: bold;">
                        <i style="font-size: 12pt;" class="<?= $title_arr['icon'] ?>"></i>
                        <span class="text"><?= $title_arr['name'] ?></span>
                    </a>    
                </li>
            </ul>
            <div class="main-menu left-menu" id="dropBox">                    
                <?php foreach ($section as $key => $sec): ?>
                    <div data-id='<?= $sec->id ?>' class="draggable">
                        <a href="<?= \yii\helpers\Url::to(['/knowledges', 'parent_id' => $sec['id']]) ?>" style="font-size: 10pt;font-family: sans-serif;font-weight: bold;">
                            <i style="font-size: 12pt;" class="<?= $sec['icon'] ?>"></i>
                            <span  class="text"><?= $sec['name'] ?></span>
                            <div class="pull-right" style="margin-top: -5px;">
                                <span class="mdi mdi-drag-vertical btnDrag" style="    font-weight: bold; font-family: sans-serif; font-size: 16pt;"></span>
                                <span class="children" data-id='<?= $sec->id ?>'></span>
                            </div>
                        </a>

                    </div>        
                <?php endforeach; ?>        
            </div>
        </nav>
        <!-- /main-nav -->
    </div>
</div>
<?php 
    $this->registerJs("
    /*show and hide button edit and drag*/
    $('.btnDrag').hide();
    $('.draggable').hover(function () {
        let id = $(this).attr('data-id');
        $('.draggable[data-id=' + id + '] .btnDrag').fadeIn('slow');
    },
            function () {
                $('.btnDrag').hide();
            }
    );
    var options_drags = {
        draggable: '.btnDrag',
        callback: function (e) {
            var positionArray = [];
            $('.draggable').find('.children').each(function () {
                positionArray.push($(this).attr('data-id'));
            });
            //delete positionArray[positionArray.length-1];
            positionArray.splice(positionArray.length - 1, positionArray.length);
            $.get('/knowledges/default/sort', {data: positionArray.toString()}, function (data) {
                console.warn(data);
            });

        }
    };
    $('.search-panel .dropdown-menu').find('a').click(function (e) {
        e.preventDefault();
        var param = $(this).attr('href').replace('#', '');
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });
    //$('#dropBox').dad(options_drags);

");
?>