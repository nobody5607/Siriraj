<?php

namespace backend\modules\sections\controllers;

use yii\web\Controller;
use Yii;
use common\models\Contents;
use backend\modules\sections\classes\JContent;
use backend\modules\sections\classes\JSection;
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
        //\appxq\sdii\utils\VarDumper::dump($breadcrumb);
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
        //\appxq\sdii\utils\VarDumper::dump($items);
        return $this->render("view", [
                    'breadcrumb' => $breadcrumb,
                    'title' => $content['name'],
                    'items' => $items,
                    'file_type' => $file_type
        ]);
        //$section_id = \Yii::$app->request->get('section_id', '');   
    }

    public function actionCreate(){  
        $section_id                 = \Yii::$app->request->get('id', '');//section_id
        $model                  = new  Contents();
        $public                 = \Yii::$app->request->get('public', '1');         
        
        if ($model->load(Yii::$app->request->post())) {
            $model->id          = \appxq\sdii\utils\SDUtility::getMillisecTime();
            $model->rstat       = 1; 
            $model->user_create = Yii::$app->user->id;
            $model->create_date = new \yii\db\Expression('NOW()');
            $model->section_id = \Yii::$app->request->post('section_id', '');
            if ($model->save()) {
                return \janpan\jn\classes\JResponse::getSuccess(\Yii::t('content', 'Create data complete'), $model);
            } else {
                return \janpan\jn\classes\JResponse::getSuccess(\Yii::t('content', 'Create Error!'));
            }
        }
        return $this->renderAjax('create',[
            'model'=>$model,
            'sec_id'=>$section_id,
            'public'=>$public
        ]);
    }
    public function actionUpdate(){  
        $id                 = \Yii::$app->request->get('id', '');//content_id        
        $public                 = \Yii::$app->request->get('public', '1');   
        $model                  = Contents::findOne($id);
         
        if ($model->load(Yii::$app->request->post())) { 
            $model->rstat       = 1; 
            $model->user_create = Yii::$app->user->id;
            $model->create_date = new \yii\db\Expression('NOW()');
            $model->section_id = \Yii::$app->request->post('section_id', '');
            if ($model->save()) {//\appxq\sdii\utils\VarDumper::dump($_POST);
                return \janpan\jn\classes\JResponse::getSuccess(\Yii::t('content', 'Create data complete'), $model);
            } else {
                return \janpan\jn\classes\JResponse::getSuccess(\Yii::t('content', 'Create Error!'));
            }
        }
        return $this->renderAjax('update',[
            'model'=>$model,
            'sec_id'=>$model['section_id'],
            'public'=>$public
        ]);
    }
    public function actionDelete(){          
        if (Yii::$app->getRequest()->isAjax) {
            $id             = \Yii::$app->request->post('id', '');	     
            $model          =  Contents::findOne($id);            
            $model->rstat   = 3;
            if($model->id == 0){
                return \janpan\jn\classes\JResponse::getError(\Yii::t('content', 'Delete Error!'));
            }
	    if ($model->save()) {
                return \janpan\jn\classes\JResponse::getSuccess(\Yii::t('content', 'Delete data complete'), $model);
            } else {
                return \janpan\jn\classes\JResponse::getError(\Yii::t('content', 'Delete Error!'));
            }
        } else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }
}
