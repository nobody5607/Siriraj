<?php
 
namespace backend\modules\section_management\classes;
use yii\db\Exception; 
class JContent {
    /**
     * 
     * @return object or false
     */
    public static function getContentAll(){
        try {
            $content = \common\models\Contents::find()->where('rstat not in(0,3)')->all();
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }
    /**
     * 
     * @param type $id  section_id
     * @return object or false
     */
    public static function getContentBySectionId($id, $type=''){
        try {
            $data = \common\models\Contents::find()
                    ->where('rstat not in(0,3)')
                    ->andWhere('section_id=:id',[':id'=>$id]);                    
                     
            if($type == 'private'){
                $content = $data->andWhere(['public'=>2]);//private
            }else{
                $content = $data->andWhere(['public'=>1]);//public
            }
            
//            \appxq\sdii\utils\VarDumper::dump($content);
            return $content->all();;
        } catch (Exception $ex) {
            return false;
        }
    }
    /**
     * 
     * @param type $id  section_id
     * @return object or false
     */
    public static function getContentById($id){
        try {
            $content = \common\models\Contents::find()
                    ->where('rstat not in(0,3)')
                    ->andWhere('id=:id',[':id'=>$id])
                    ->one();
//            \appxq\sdii\utils\VarDumper::dump($content);
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public static function getIDContentBySectionIdAll($id){
       $section = JSection::getSectionById($id, 'all');
       $id_arr=[];
       foreach($section as $s){
           $data = self::getSub($s['id']);
           array_push($id_arr, $data);
       }
        
    }
    public static function getSub($id){
        
        $section = JSection::getSectionByParentId($id, 'all');
        if($section){
            foreach($section as $s){
                if($s['parent_id'] != '0'){
                    $section = self::getSub($s['id']);
                }
            }
        }
        return $section;
    }
    
}
