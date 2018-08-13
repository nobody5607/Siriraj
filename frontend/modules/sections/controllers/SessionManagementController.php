<?php

namespace frontend\modules\sections\controllers;

use yii\web\Controller;
use frontend\modules\sections\classes\JSection;
use frontend\modules\sections\classes\JContent;
use common\models\Sections;
use Yii;
class SessionManagementController extends Controller
{ 
    public function actionIndex(){    
        $id = \Yii::$app->request->get('id', '');        
        if($id){
            $content_section = JSection::getSectionById($id);
            $section = JSection::getChildren($id);               
        }else{
            $content_section = JSection::getRoot(); 
            $section = JSection::getRootSection(); 
             
        }
        $public = isset($content_section) ? '1' : '2';
        
        $breadcrumb = JSection::getBreadcrumb($id);
//        \appxq\sdii\utils\VarDumper::dump($breadcrumb);
        $title = JSection::getTitle($id);        
        $content = isset($id) ? JContent::getContentBySectionId($id, 1) : JContent::getContentAll(1); 
       
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$section,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        $contentProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$content,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);          
        
        return $this->render("index",[
            'dataProvider'=>$dataProvider,
            'contentProvider'=>$contentProvider,
            'breadcrumb'=>$breadcrumb,
            'title'=>($title['id']==0) ? '' : $title['name'],
            'content_section'=>$content_section,
            'public'=>$public
        ]);
    }
    
    public function actionGetDynamicItem(){
        $id = \Yii::$app->request->get('id', '');
        $data = \frontend\modules\sections\classes\JSectionQuery::getSectionAll($id);         
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$data,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        if(!$data){
            return '';
        }
          
        return $this->renderAjax("items/get-dynamic-item",[
            'dataProvider'=>$dataProvider,
            'data'=>$data
        ]);
    }
     
}
