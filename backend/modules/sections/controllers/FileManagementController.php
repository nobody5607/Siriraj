<?php

namespace backend\modules\sections\controllers;

use Yii;
use common\models\ContentChoice;
use backend\modules\sections\models\FileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;
//upload images
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\image\drivers\Image;


/**
 * FileManagementController implements the CRUD actions for ContentChoice model.
 */
class FileManagementController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                //'only' => ['index'],
                'rules' => \backend\components\Rbac::getRbac(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
     

    public function beforeAction($action) {
	if (parent::beforeAction($action)) {
	    if (in_array($action->id, array('create', 'update'))) {
		
	    }
	    return true;
	} else {
	    return false;
	}
    }
    
    /**
     * Lists all ContentChoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentChoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    return $this->renderAjax('view', [
		'model' => $this->findModel($id),
	    ]);
	} else {
	    return $this->render('view', [
		'model' => $this->findModel($id),
	    ]);
	}
    }

    /**
     * Creates a new ContentChoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model              = new ContentChoice();
            $content_id         = \Yii::$app->request->get('content_id', '');
            $filet_id           = \Yii::$app->request->get('filet_id', '');
            $model->content_id  = $content_id;
            $model->type        = $filet_id;
	    if ($model->load(Yii::$app->request->post())) {
                if($model->default == 1){
                    //default
                    $choice = ContentChoice::find()->where(['content_id'=>$model->content_id, 'type'=>$model->type])->all();
                    foreach($choice as $c){
                        $c->default = 0;
                        $c->update();
                    }
                    //\Yii::$app->db->createCommand()->update($table, $columns, $condition, $params);
                }  
		if ($model->save()) {		 
                    return \janpan\jn\classes\JResponse::getSuccess(Yii::t('file', 'Update completed.'), $model);
                } else {
                    return \janpan\jn\classes\JResponse::getError(Yii::t('app', 'Can not update the data.'), $model);
                }
	    } else {
		return $this->renderAjax('create', [
		    'model' => $model,
		]);
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }

    /**
     * Updates an existing ContentChoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model = $this->findModel($id);
	    if ($model->load(Yii::$app->request->post())) { 
                if($model->default == 1){
                    $choice = ContentChoice::find()->where(['content_id'=>$model->content_id, 'type'=>$model->type])->all();
                    foreach($choice as $c){
                        $c->default = 0;
                        $c->update();
                    }
                    //default
                    //ContentChoice::updateAll(['default'=>0, 'type'=>$model->type, 'content_id'=>$model->content_id]); 
                    //\Yii::$app->db->createCommand()->update($table, $columns, $condition, $params);
                }  
		if ($model->save()) {		 
                    return \janpan\jn\classes\JResponse::getSuccess(Yii::t('file', 'Update completed.'), $model);
                } else {
                    return \janpan\jn\classes\JResponse::getError(Yii::t('app', 'Can not update the data.'), $model);
                }
	    } else {
		return $this->renderAjax('update', [
		    'model' => $model,
		]);
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }

    /**
     * Deletes an existing ContentChoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
	if (Yii::$app->getRequest()->isAjax) { 
            $id = \Yii::$app->request->post('id', '');
            $model = $this->findModel($id); 
	    if ($model->delete()) {		 
                return \janpan\jn\classes\JResponse::getSuccess(Yii::t('file', 'Deleted completed.'), $model);
	    } else {
		return \janpan\jn\classes\JResponse::getError(Yii::t('app', 'Can not delete the data.'), $model);
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }

    public function actionDeletes() {
	if (Yii::$app->getRequest()->isAjax) {
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    if (isset($_POST['selection'])) {
		foreach ($_POST['selection'] as $id) {
		    $this->findModel($id)->delete();
		}
		$result = [
		    'status' => 'success',
		    'action' => 'deletes',
		    'message' => SDHtml::getMsgSuccess() . Yii::t('app', 'Deleted completed.'),
		    'data' => $_POST['selection'],
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
    
    /**
     * Finds the ContentChoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentChoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentChoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 
    public function actionUploadFile()
    {
        $file_type = Yii::$app->request->get('file_type', '');
        $content_id = Yii::$app->request->get('content_id', '');
        $model = new \common\models\Files();
        $model->file_type       = $file_type;
        
        if (Yii::$app->request->isPost) {            
            $folderName                 = \appxq\sdii\utils\SDUtility::getMillisecTime();
            $files                      = UploadedFile::getInstancesByName('name'); 
            
            if ($files) {
                    $folder             = "/web/files";
                    $path               = Yii::getAlias('@storage') . "{$folder}/{$folderName}";
                    if($file_type == '2'){
                        \backend\modules\sections\classes\JFiles::CreateDir($path, true); //create folder
                    }else{
                        \backend\modules\sections\classes\JFiles::CreateDir($path, false); //create folder
                    }
                    $watermark = \backend\models\Watermark::find()->where(['default'=>1])->one();
                    $out=[];
                    $obj=['type'=>''];
                    foreach ($files as $file) {                        
                        $fileName       = $file->baseName . '.' . $file->extension;
                        $realFileName   = md5($folderName . time());// . '.' . $file->extension;
                        $filePath       = "{$path}/{$realFileName}";
                        $fileType       = explode('/', $file->type);
                        $thumbnail      = "{$path}/thumbnail/{$realFileName}.jpg";                        
                        $viewPath = Yii::getAlias('@storageUrl') . "{$folder}/{$folderName}";                          
                        
                        if($fileType[0] === 'image'){//images                             
                            $obj = \backend\modules\sections\classes\JFiles::uploadImage($file, $filePath, $fileType,$thumbnail,$watermark);                            
                        }else if($fileType[0] === 'application'){
                           $obj = \backend\modules\sections\classes\JFiles::uploadDocx($file,$filePath);
                        }else if($fileType[0] === 'video'){
                           //$folderName = 10000001 
                           $obj = \backend\modules\sections\classes\JFiles::uploadVideo($file,$filePath, $watermark);
                           //\appxq\sdii\utils\VarDumper::dump($obj);
                        }else{
                            $obj = \backend\modules\sections\classes\JFiles::uploadDocx($file,$filePath);
                        }
                        
                        $save_data = \backend\modules\sections\classes\JFiles::Save($model, "{$realFileName}.{$obj['type']}", $content_id, $viewPath, $fileName, $file, "{$folder}/{$folderName}");
                    }
                    return \janpan\jn\classes\JResponse::getSuccess("Upload {$realFileName} Success"); 
                }             
        }
        
        return $this->renderAjax('upload-file' , [
            'model'=>$model
        ]);
    }
    public function actionDeleteFile(){
        try {
            $id= Yii::$app->request->post('id', '');
            $model = \common\models\Files::find()->where(['id'=>$id])->one();
            //\appxq\sdii\utils\VarDumper::dump($id);

            $filename = Yii::getAlias('@storage') . "{$model->dir_path}/{$model->file_name}";
            //\appxq\sdii\utils\VarDumper::dump($filename);
            $thumbnail = Yii::getAlias('@storage') . "{$model->dir_path}/thumbnail/{$model->file_name}";
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                return \janpan\jn\classes\JResponse::getSuccess("Delete Success");
            } else {
                return \janpan\jn\classes\JResponse::getError("Error");
            }
        } catch (\yii\db\Exception $ex) {
            
        }
    }
     
    
   private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory($dir);
  }

    
    
}
