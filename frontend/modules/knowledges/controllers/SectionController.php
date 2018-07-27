<?php
 
namespace frontend\modules\knowledges\controllers;
use frontend\modules\knowledges\classes\JSection;
class SectionController extends \yii\web\Controller{
    public function actionIndex(){    
        $id = \Yii::$app->request->get('id', '');        
        $section = JSection::getRootSection();
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
                'pageSize' => 10,
            ],
        ]);          
        return $this->render("index",[
            'dataProvider'=>$dataProvider,
            'contentProvider'=>$contentProvider
        ]);
    }
}
