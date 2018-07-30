<?php
namespace frontend\modules\knowledges\classes;
use yii\db\Exception;
class JSection extends \yii\base\Component{
    
    public $level_each_rows=[];
    /**
     * 
     * @param type $parent_id string '1'
     * @return object or false
     */
    public static function getRootSection(){
       try{
            return self::getSessionByCondition('parent_id = 0', 'all');       
       } catch (yii\db\Exception $ex){
           return false;
       }
    }
     
    public static function getChildren($id){
        try{
            $section = \common\models\Sections::find()->where(['parent_id'=>$id])->all();
            $datas = [];             
             
            foreach($section as $s){
                $data = (new \yii\db\Query())
                    ->select('@pv:=`id` as data_id, tbl_sections.*')
                    ->from('tbl_sections')
                    ->innerJoin("(select @pv:={$s['parent_id']})tmp")
                    ->where("parent_id=@pv")->all(); 
                $datas = \yii\helpers\ArrayHelper::merge($datas, $data);
//                array_push($datas, $data); 
            }
            // \appxq\sdii\utils\VarDumper::dump($section);
            return $section;
        } catch (Exception $ex) {
            return false;
        }
    }
    /**
     * 
     * @param type $menu_head
     * @param type $section
     * @param type $default != show default title
     * @return type
     */
    public static function getTitle($parent_id){
         $section = \common\models\Sections::findOne($parent_id);
         return $section;
    }
    /**
     * 
     * @param type $parent_id id 
     * @return boolean|array
     */
    public static function getBreadcrumb($parent_id){
        try{
            $breadcrumbs = [
                ['label' => \Yii::t('knowledges', 'ห้องความรู้'), 'url' => ['/knowledges']]
            ]; 
            $sql="
               SELECT c.*
                FROM (
                    SELECT
                        @r AS _id,
                        (SELECT @r := parent_id FROM tbl_sections WHERE `id` = _id) AS parent_id,
                        @l := @l + 1 AS level
                    FROM
                        (SELECT @r := {$parent_id}, @l := 0) vars, tbl_sections m
                    WHERE @r <> 0) d
                JOIN tbl_sections c
                ON d._id = c.id  
                ORDER BY c.id ASC
            ";
            $data = \Yii::$app->db->createCommand($sql)->queryAll();
            $breadcrumbs=[];            
            if($data){                
                $breadcrumbs[0]=['label' => \Yii::t('knowledges', 'ห้องความรู้'), 'url' => ['/knowledges/section']]; 
                foreach($data as $key => $d){              
                  $breadcrumbs[$key+1] = [
                      'label' =>$d['name'], 
                      'url' => ['/knowledges/section', 'id'=>$d['id']]];
                }
                
                return $breadcrumbs;
                
            }else{
                $breadcrumbs[0]=['label' => \Yii::t('knowledges', 'ห้องความรู้'), 'url' => ['/knowledges/section']]; 
                \appxq\sdii\utils\VarDumper::dump($breadcrumbs);
                return $breadcrumbs;
            }
                
        } catch (Exception $ex) {
            return false;
        }
    }

        /**
     * 
     * @param type $parent_id string '1'
     * @return object or false
     */
    public static function getSessionAll(){
       try{
            return self::getSessionByCondition('', 'all');       
       } catch (yii\db\Exception $ex){
           return false;
       }
    }
    /**
     * 
     * @param type $condition array ['id'=>$id]
     * @param type string type = 'all' , 'one'
     * @return boolean
     */
    private static function getSessionByCondition($condition, $type='all'){
        try{
            $data = \common\models\Sections::find()->where('rstat not in(0,3) and public = 1');  
            if(!empty($condition)){
                $section = $data->andWhere($condition);
            }
            
            $section = $data->orderBy(['forder' => SORT_ASC]);
            if($type == 'one'){$section =$data->one();}
            else{$section=$data->all();}
            return $section;
        } catch (Exception $ex) {
            return false;
        }
    }
    /**
     * 
     * @param type $parent_id string '1'
     * @return object or false
     */
    public static function getSectionByParentId($parent_id, $type="all"){
       try{
            $condition=['parent_id' => $parent_id];
            return self::getSessionByCondition($condition, $type);       
       } catch (yii\db\Exception $ex){
           return false;
       }
    }
    /**
     * 
     * @param type $parent_id string '1'
     * @return object or false
     */
    public static function getSectionById($id, $type='one'){
       try{
            $condition=['id' => $id];
            return self::getSessionByCondition($condition, $type);       
       } catch (yii\db\Exception $ex){
           return false;
       }
    }
    
    public static function setBreadcrumbs($id){
        $data = self::getSectionById($id, 'one');        
        $breadcrumbs = [
          ['label' => \Yii::t('knowledges', 'ห้องความรู้'), 'url' => ['/knowledges']]
        ];        
        
        if($data){
           if($data['parent_id'] == 0){
              $breadcrumbs[count($breadcrumbs)] = ['label' =>$data['name'], 'url' => ['/knowledges', 'parent_id'=>$data['id']]];
           }else{
               $n = 1;              
               $secid=[];
               $idnow = $data['id'];
               array_push($secid, $idnow);
                while ($n <= 100){ //ถ้า parent <> 0               
                   //หา id แม่
                   $data = self::getSectionById($data['parent_id'], 'one');
                   if($data['parent_id'] == '0'){
                      array_push($secid, $data['id']);                      
                   }else{
                       if($data['id'] != ''){
                           array_push($secid, $data['id']);
                       } 
                   }
                   
                   $n++;
                }
                sort($secid);                
                foreach($secid as $id){
                    $data = self::getSectionById($id, 'one');
                    $breadcrumbs[count($breadcrumbs)] = ['label' =>$data['name'], 'url' => ['/knowledges', 'parent_id'=>$data['id']]];
                }
                //\appxq\sdii\utils\VarDumper::dump($breadcrumbs);
           }
                    
        }
        
       //
        return $breadcrumbs;
    }
    
}
