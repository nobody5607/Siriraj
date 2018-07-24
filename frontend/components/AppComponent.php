<?php
namespace frontend\components;
class AppComponent {
    public static function sectionRoot(){
        $root = \common\models\Sections::find()->where('parent_id=0 and rstat not in(0,3)')->orderBy(['forder'=>SORT_ASC])->all();
        if($root){
            return $root;
        }
    }
}
