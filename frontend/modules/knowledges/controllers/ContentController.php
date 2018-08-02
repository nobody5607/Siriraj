<?php

namespace frontend\modules\knowledges\controllers;
use yii\web\Controller; 
use frontend\modules\knowledges\classes\JSection;
use frontend\modules\knowledges\classes\JContent;
use common\models\FileType;
class ContentController extends Controller
{
    public function actionView()
    {
        $content_id         = \Yii::$app->request->get('content_id', '');
        $content            =  JContent::getContentById($content_id);
        //\appxq\sdii\utils\VarDumper::dump($id);
        $breadcrumb         = JSection::getBreadcrumb($content['section_id']);
        $file_type          = FileType::find()->all();
        $items              = [];
        foreach($file_type as $key=> $type){
           if($key==0){               
           }else{
               $items[$key-1] =[
                    'label'=>"<i class='fa fa-{$type['icon']}'></i> {$type['name']}",
                    'content'=>'test1',
                    'active'=>($key == 0) ? true : false,
                    'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/knowledges/content/get-view', 'content_id'=>$content_id, 'type_id'=>$type['id']])]        

                ]; 
           }
           
        }
       //\appxq\sdii\utils\VarDumper::dump($items);
        return $this->render("view",[
            'breadcrumb'=>$breadcrumb,
            'title'=>$content['name'],
            'items'=>$items
        ]);
        //$section_id = \Yii::$app->request->get('section_id', '');
    }
    public function actionGetView(){
        $content_id         = \Yii::$app->request->get('content_id', '');
        $type_id            = \Yii::$app->request->get('type_id', '');
        $content            =  JContent::getContentById($content_id);
        $files              = \common\models\Files::find()
                ->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3) AND public = 1',
                        [':content_id'=>$content_id , ':file_type'=>$type_id])->all();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$files,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $html = $this->renderAjax("get-view",[
             'dataProvider'=>$dataProvider
        ]);
        return \yii\helpers\Json::encode($html);
    }
    
}
