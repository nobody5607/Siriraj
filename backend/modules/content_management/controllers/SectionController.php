<?php
 
namespace backend\modules\content_management\controllers;
use Yii;
use common\models\Contents;
use backend\modules\content_management\models\ContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;
use backend\modules\section_management\classes\JSection;

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
        $content = \backend\modules\section_management\classes\JContent::getContentBySectionId($id);
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
    
    public function actionUpdate(){  
        $id = \Yii::$app->request->get('id', '');  
        
        $model = \common\models\Sections::findOne($id);
        
        if ($model->load(\Yii::$app->request->post())) {
            if($model->save()){
                 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $result = [
                    'status' => 'success',
                    'action' => 'create',
                    'message' => \appxq\sdii\helpers\SDHtml::getMsgSuccess() . \Yii::t('app', 'Data completed.'),
                    'data' => $model,
                ];
                return $result;
            }else{
                $result = [
                    'status' => 'error',
                    'message' => \appxq\sdii\helpers\SDHtml::getMsgError() . \Yii::t('app', 'Can not create the data.'),
                    'data' => $model,
                ];
                return $result;  
            }           
        } 
        return $this->renderAjax('update',[
            'model'=>$model
        ]);
    }
    public function actionUpdateContent(){  
        $id = \Yii::$app->request->get('id', '');
        $model = \common\models\Contents::findOne($id);
        
        if ($model->load(Yii::$app->request->post())) {
            //$model->id = \appxq\sdii\utils\SDUtility::getMillisecTime();
            $model->rstat = 1; 
            $model->user_create = Yii::$app->user->id;
            $model->create_date = new \yii\db\Expression('NOW()');
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                $result = [
                    'status' => 'success',
                    'action' => 'update',
                    'message' => SDHtml::getMsgSuccess() . Yii::t('app', 'Data completed.'),
                    'data' => $model,
                ];
                return $result;
            } else {
                $result = [
                    'status' => 'error',
                    'message' => SDHtml::getMsgError() . Yii::t('app', 'Can not update the data.'),
                    'data' => $model,
                ];
                return $result;
            }
        }
        return $this->renderAjax('update-content',[
            'model'=>$model
        ]);
    }
    public function actionDeleteContent(){  
        
        if (Yii::$app->getRequest()->isAjax) {
            $id = \Yii::$app->request->post('id', '');
	    Yii::$app->response->format = Response::FORMAT_JSON;
            $model = \common\models\Contents::findOne($id);
            $model->rstat = 3;
            if($model->id == 0){
                $result = [
		    'status' => 'error',
		    'message' => SDHtml::getMsgError() . Yii::t('app', 'Can not delete the data.'),
		    'data' => $id,
		];
		return $result;
            }
	    if ($model->save()) {
		$result = [
		    'status' => 'success',
		    'action' => 'update',
		    'message' => SDHtml::getMsgSuccess() . Yii::t('app', 'Deleted completed.'),
		    'data' => $id,
		];
		return $result;
	    } else {
		$result = [
		    'status' => 'error',
		    'message' => SDHtml::getMsgError() . Yii::t('app', 'Can not delete the data.'),
		    'data' => $id,
		];
		return $result;
	    } 
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }
}
