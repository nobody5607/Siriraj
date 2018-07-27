<?php
 

namespace frontend\modules\knowledges\classes;
 
class JFiles {
    public static function getTypeFile(){
       $type = \common\models\FileType::find()->all();
       if($type){
           return $type;
       }
    }
}
