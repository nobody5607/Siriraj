<?php
 
namespace frontend\modules\knowledges\controllers;
use frontend\modules\knowledges\classes\JSection;
class SectionController extends \yii\web\Controller{
    public function actionIndex(){    
        $id = \Yii::$app->request->get('id', '');         
        $section = JSection::getRootSection();
        if($id){
            $section = JSection::getChildren($id);
            //\appxq\sdii\utils\VarDumper::dump($section);
        }
        $content_section = JSection::getRoot();
        $breadcrumb = JSection::getBreadcrumb($id);
        $title = JSection::getTitle($id);        
        $content = \frontend\modules\knowledges\classes\JContent::getContentAll();
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
            'title'=>$title,
            'content_section'=>$content_section
        ]);
    }
    public function actionView(){    
        $id = \Yii::$app->request->get('id', '');         
        $section = JSection::getRootSection();
        $content_section = JSection::getPTYSectionById($id);
        if($id){
            $group_section = JSection::getSectionArrById($id);
            $section = JSection::getChildren($id);
        }
        $breadcrumb = JSection::getBreadcrumb($id);
        $title = JSection::getTitle($id);        
        $content = \frontend\modules\knowledges\classes\JContent::getContentBySectionId($id);
        //\appxq\sdii\utils\VarDumper::dump($content);
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
        return $this->render("view",[
            'dataProvider'=>$dataProvider,
            'contentProvider'=>$contentProvider,
            'breadcrumb'=>$breadcrumb,
            'title'=>$title,
            'content_section'=>$content_section
        ]);
    }
}
