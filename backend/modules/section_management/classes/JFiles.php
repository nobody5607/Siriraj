<?php
 

namespace backend\modules\section_management\classes;
 
class JFiles {
    public static function getTypeFile(){
       $type = \common\models\FileType::find()->all();
       if($type){
           return $type;
       }
    }
}
