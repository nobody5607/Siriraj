<?php
 

namespace backend\modules\content_management\models;
use Yii; 
class TreeSections extends \kartik\tree\models\Tree{
   public $lvl, $lft, $rgt, $icon_type;
   public static function tableName() {
        return 'tbl_sections';
   }

    public function isDisabled() {
         
    }

}
