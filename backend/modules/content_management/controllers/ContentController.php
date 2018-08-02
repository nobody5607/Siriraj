<?php

namespace backend\modules\content_management\controllers;
use yii\web\Controller; 
use backend\modules\section_management\classes\JSection;
use frontend\modules\knowledges\classes\JContent;
use common\models\FileType;
class ContentController extends Controller
{
    public function actionView()
    {
        $content_id         = \Yii::$app->request->get('content_id', '');
        $content            =  JContent::getContentById($content_id);         
        $breadcrumb         = JSection::getBreadcrumb($content['section_id']);       
        $breadcrumb[] = ['label' =>$content['name']];       
        //\appxq\sdii\utils\VarDumper::dump($breadcrumb);
        $file_type          = FileType::find()->all();
        $items              = [];
        foreach($file_type as $key=> $type){
           if($key==0){               
           }else{
               $items[$key-1] =[
                    'label'=>"<i class='fa fa-{$type['icon']}'></i> {$type['name']}",
                    'content'=>'test1',
                    'active'=>($key == 0) ? true : false,
                    'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/content_management/content/get-view', 'content_id'=>$content_id, 'type_id'=>$type['id']])]        

                ]; 
           }
           
        }
       //\appxq\sdii\utils\VarDumper::dump($items);
        return $this->render("view",[
            'breadcrumb'=>$breadcrumb,
            'title'=>$content['name'],
            'items'=>$items,
            'file_type'=>$file_type
        ]);
        //$section_id = \Yii::$app->request->get('section_id', '');
    }
    public function actionViewContentData(){
        $content_id         = \Yii::$app->request->get('content_id', '');
        $content            =  JContent::getContentById($content_id);
        $file_id            = \Yii::$app->request->get('file_id', '');
        $filet_id           = \Yii::$app->request->get('filet_id', '');
        $content            =  JContent::getContentById($content_id);
        $breadcrumb         = JSection::getBreadcrumb($content['section_id']);         
        $breadcrumb[]       = ['label' =>$content['name'],'url' => ['/content_management/content/view', 'content_id'=>$content['id']]];  
        $files              = \common\models\Files::find()->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3) AND public = 1',[':content_id'=>$content_id , ':file_type'=>$filet_id]);
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$files->all(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $dataDefault = $files->andWhere('id=:id', [':id'=>$file_id])->one();
         
        return $this->render("view-content-data",[
            'breadcrumb'=>$breadcrumb,
            'dataProvider'=>$dataProvider,
            'dataDefault'=>$dataDefault
        ]);
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
    public function actionGetCountData(){
        $content_id         = \Yii::$app->request->get('content_id', '');
        $type_id            = \Yii::$app->request->get('type_id', '');
        $content            =  JContent::getContentById($content_id);
        $files              = \common\models\Files::find()
                ->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3) AND public = 1',
                        [':content_id'=>$content_id , ':file_type'=>$type_id])->all();
        $str = \Yii::t('content', 'ไฟล์');
        if($type_id == 2){
            $str = \Yii::t('content', 'ภาพ');
        }
        if($files){
            return count($files)." {$str}";
        }else{
            return "0 {$str}";
        }
    }
    public function actionGetData(){
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
        return $this->renderAjax("get-data",[
             'dataProvider'=>$dataProvider
        ]);
    }
    
}
