<?php 
if (Yii::$app->user->isGuest) {
    if ($model['file_type'] == "2") {
        echo $this->render("_item-view", [
            'content_id' => Yii::$app->request->get('content_id', ''),
            'model' => $model
        ]);
    }
}
//else if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin") || Yii::$app->user->can("users"))){
$fileType = ['2', '3', '4', '5', '6', '7', '8'];
if (in_array($model['file_type'], $fileType)) {
    echo $this->render("_item-view", [
        'content_id' => Yii::$app->request->get('content_id', ''),
        'model' => $model
    ]);
}
//}
?>