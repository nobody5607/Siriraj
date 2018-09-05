<?php

namespace frontend\modules\sections\controllers;

use yii\web\Controller;
use Yii;
use common\models\Contents;
use frontend\modules\sections\classes\JContent;
use frontend\modules\sections\classes\JSection;
use common\models\FileType;
/**
 * Default controller for the `sections` module
 */
class ContentManagementController extends Controller
{
 
    public function actionIndex()
    {
        
        return $this->render('index');
    }
    public function actionView() {
        
        $content_id = \Yii::$app->request->get('content_id', '');
        $content = JContent::getContentById($content_id);
        $breadcrumb = JSection::getBreadcrumb($content['section_id']);
        $breadcrumb[] = ['label' => $content['name']];
        
        $file_type = FileType::find()->all();
         
        $items = [];
        foreach ($file_type as $key => $type) {
            if ($key == 0) {
                
            } else {
                $items[$key - 1] = [
                    'label' => "<i class='fa fa-{$type['icon']}'></i> {$type['name']}",
                    'content' => 'test1',
                    'active' => ($key == 0) ? true : false,
                    'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/content_management/content/get-view', 'content_id' => $content_id, 'type_id' => $type['id']])]
                ];
            }
        }
        
        return $this->render("view", [
                    'breadcrumb' => $breadcrumb,
                    'title' => $content['name'],
                    'items' => $items,
                    'file_type' => $file_type
        ]);
        //$section_id = \Yii::$app->request->get('section_id', '');   
    }
    public function actionViewDataContent(){
        $content_id         = \Yii::$app->request->get('content_id', '');
        $type_id            = \Yii::$app->request->get('type_id', '');
        $content            =  JContent::getContentById($content_id);
        $files              = \common\models\Files::find()
                ->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3)',
                        [':content_id'=>$content_id , ':file_type'=>$type_id])->all();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$files,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->renderAjax("view-data-content",[
             'dataProvider'=>$dataProvider
        ]);
    }
    public function actionGetCountData(){
        $content_id         = \Yii::$app->request->get('content_id', '');
        $type_id            = \Yii::$app->request->get('type_id', '');
        $content            =  JContent::getContentById($content_id);
        $files              = \common\models\Files::find()
                ->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3)',
                        [':content_id'=>$content_id , ':file_type'=>$type_id])->all();
        $str = \Yii::t('content', 'ไฟล์');
        if($type_id == 2){
            $str = \Yii::t('content', 'ภาพ');
        }
        if($files){
            return count($files)." {$str}";
        }else{
            if(count($files) == 0){
                $html = "";
                //$html .= "<script>$('.read-all').remove();</script>";
                $html .= "0 {$str}";
                return $html;
            }
            
        }
    }
    
    public function actionViewFile(){
        $content_id         = \Yii::$app->request->get('content_id', '');
        $content            =  JContent::getContentById($content_id);
        $file_id            = \Yii::$app->request->get('file_id', '');
        $filet_id           = \Yii::$app->request->get('filet_id', '');
        $content            =  JContent::getContentById($content_id);
        $breadcrumb         = JSection::getBreadcrumb($content['section_id']);   
        
        $breadcrumb[]       = ['label' =>$content['name'],'url' => ["/sections/content-management/view?content_id={$content['id']}"]];  
        $files              = \common\models\Files::find()->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3)',[':content_id'=>$content_id , ':file_type'=>$filet_id]);
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$files->all(),
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
        $dataDefault = $files->andWhere('id=:id', [':id'=>$file_id])->one();
        if($file_id == ''){
            $dataDefault = \common\models\Files::find()->where(['file_type'=>$filet_id])->one();
        }
        //\appxq\sdii\utils\VarDumper::dump($dataDefault);
        
        
        
        /* add template */
        $addTemplate    = JContent::addTemplate($content_id);
        $choice         = JContent::getChoice($content_id, $filet_id);
                //\appxq\sdii\utils\VarDumper::dump($check_choice);
        $this->layout = "@frontend/themes/siriraj/layouts/main-second"; 
        return $this->render("view-file/index",[
            'breadcrumb'=>$breadcrumb,
            'dataProvider'=>$dataProvider,
            'dataDefault'=>$dataDefault,
            'title'=>$content['name'],
            'choice'=>$choice
        ]); 
    }
    
    
}
