<?php
namespace frontend\modules\knowledges\classes;
use yii\db\Exception;
class JSection {
    
    
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
    /**
     * 
     * @param type $menu_head
     * @param type $section
     * @param type $default != show default title
     * @return type
     */
    public static function setTitle($menu_head, $section, $default=''){
        if($default != ''){
            return ['name'=>'ห้องความรู้', 'url'=>'/knowledges', 'title'=>'ห้องความรู้', 'icon'=>'fa fa-home'];
        }
        $title_arr=[
                'title'=> isset($menu_head['name']) ? $menu_head['name'] : 'ห้องความรู้',
                'url'=> \yii\helpers\Url::to(['/knowledges','parent_id'=> isset($section['parent_id']) ? $section['parent_id'] : 0]),
                'name'=>isset($menu_head['name']) ? $menu_head['name'] : 'ห้องความรู้',
                'icon'=>isset($menu_head['icon']) ? $menu_head['icon'] : 'fa fa-home',
        ];
        return $title_arr;
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
