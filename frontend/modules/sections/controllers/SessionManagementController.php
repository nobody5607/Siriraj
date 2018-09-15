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
        return $this->redirect(['/sections/section']);
        \frontend\modules\sections\classes\JCounter::saveCounter();
                
        $id = \Yii::$app->request->get('id', '');        
        if($id){
            $content_section = JSection::getSectionById($id);
            $section = JSection::getChildren($id);
            $content = JSection::getChildren($id, "content");
            
        }else{
            $content_section = JSection::getRoot(); 
            $section = JSection::getRootSection(); 
            $content = JSection::getRootSection(); 
             
        }        
        $public = isset($content_section) ? '1' : '2';
        
        $breadcrumb = JSection::getBreadcrumb($id);
//        \appxq\sdii\utils\VarDumper::dump($breadcrumb);
        $title = JSection::getTitle($id);        
        //$content = isset($id) ? JContent::getContentBySectionId($id, 1) : JContent::getContentAll(1);
        
       
        
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
        //\appxq\sdii\utils\VarDumper::dump($id);
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
    
    public function actionSearch(){
        $type_id    = Yii::$app->request->get('type_id', '');
        $txtsearch = Yii::$app->request->get('txtsearch', '');
        $fileType = \common\models\FileType::findOne($type_id);
        $data = \common\models\Files::find();
        $model = $data->where('description LIKE :description  OR detail_meta LIKE :detail_meta  OR file_name_org LIKE :file_name OR meta_text LIKE :meta_text',[
            ':description'=>"%{$txtsearch}%",
            ':detail_meta'=>"%{$txtsearch}%",
            ':file_name'=>"%{$txtsearch}%",
            ':meta_text'=>"%{$txtsearch}%",
             
        ]);
        if($type_id == 0 || $type_id == ""){
            $type_id = 1;
        }
        //\appxq\sdii\utils\VarDumper::dump($type_id);
        $types = ['1', 'all'];
        if(!in_array($type_id, $types)){
            $model=$data->andWhere("file_type=:file_type", [":file_type"=>$type_id]);  
            //\appxq\sdii\utils\VarDumper::dump($type_id);
        }
        
        if(!empty($model)){
            $keyword =  \common\models\KeywordSearch::find()->where(['word'=>$txtsearch])->one();
            
            if(!$keyword){
                $keyword = new \common\models\KeywordSearch();
                $keyword->id = \appxq\sdii\utils\SDUtility::getMillisecTime();
                $keyword->status = 1;
                $keyword->date = date('Y-m-d H:i:s');
                if($keyword->save()){
                    
                }else{
                    \appxq\sdii\utils\VarDumper::dump($keyword->errors);
                }
            }
             
        }
        $this->layout = "@frontend/themes/siriraj/layouts/main-second"; 
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,  
                ]
            ],
        ]);            
        return $this->render("searchs/search",[
            'dataProvider'=>$dataProvider,
            'txtsearch'=> isset($txtsearch) ? $txtsearch : '',
            'fileType'=>$fileType
        ]); 
    }
}
