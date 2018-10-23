<?php 
    $this->title = 'คลังสมบัติของพิพิธภัณฑ์ศิริราช | ค้นพบเรื่องราวประวัติศาสตร์ฝั่งธนฯ และการแพทย์ได้ที่นี่';
    Yii::$app->meta->keywords = 'คลังสมบัติของพิพิธภัณฑ์ศิริราช , Siriraj museum (Unravel) treasure , ค้นพบเรื่องราวประวัติศาสตร์ฝั่งธนฯ และการแพทย์ได้ที่นี่ , รอบรั้วศิริราช , พิพิธภัณฑ์ศิริราช , กรุงธนบุรี ,รวมบทความน่าอ่าน';
    Yii::$app->meta->description = 'ค้นพบเรื่องราวประวัติศาสตร์ฝั่งธนฯ และการแพทย์ได้ที่นี่';
    Yii::$app->meta->image = 'https://srr.thaicarecloud.org/images/logosirirajweb3.png';//Yii::getAlias('@web').'/images/myimage.jpg';
?>

<div id="content" class="content">
<?=
\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'row',
        //        'id' => 'section-all',
        'id' => 'ezf_dad',
    ],
    'itemOptions' => function($model) {
        return ['tag' => 'div','class' => 'bg-green flex-display mb10 wd-100'];
    },
    'layout' => "{items}\n",
    'itemView' => function ($model, $key, $index, $widget) {
        
        return $this->render('_items', ['model' => $model, 'key'=>$key+1]);
    },
]);
?>
</div>