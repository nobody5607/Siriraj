<?php 
//if (Yii::$app->user->isGuest) {
    if ($model['file_type'] == "2") {
        echo $this->render("_item-view", [
            'content_id' => Yii::$app->request->get('content_id', ''),
            'model' => $model
        ]);
    }
//}
$fileType = ['3', '4', '5', '6', '7', '8'];
if (in_array($model['file_type'], $fileType)) {
    \appxq\sdii\utils\VarDumper::dump($model);
    echo $this->render("_item-view", [
        'content_id' => Yii::$app->request->get('content_id', ''),
        'model' => $model
    ]);
}

//}
?>