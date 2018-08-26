<?php

namespace backend\modules\viewcountermanagement\controllers;

use Yii;
use common\models\View;
use backend\modules\viewcountermanagement\models\ViewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;

/**
 * ViewCountController implements the CRUD actions for View model.
 */
class ViewCountController extends Controller
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
     * Lists all View models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPreview()
    {
 
        $print = Yii::$app->request->get('print', '');
        $month = Yii::$app->request->get('month', '');
        $year = Yii::$app->request->get('year', '');
        $start_date = "{$year}-{$month}-00";
        if($month == "00" || $month == ""){            
            $sql="
                SELECT 
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-01-01' AND '{$year}-01-31') as m1,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-02-01' AND '{$year}-02-31') as m2,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-03-01' AND '{$year}-03-31') as m3,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-04-01' AND '{$year}-04-31') as m4, 
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-05-01' AND '{$year}-05-31') as m5,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-06-01' AND '{$year}-06-31') as m6,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-07-01' AND '{$year}-07-31') as m7,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-08-01' AND '{$year}-08-31') as m8,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-09-01' AND '{$year}-09-31') as m9,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-10-01' AND '{$year}-10-31') as m10,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-11-01' AND '{$year}-11-31') as m11,
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-12-01' AND '{$year}-11-31') as m12  
              FROM tbl_view limit 1
            ";
            $data = Yii::$app->db->createCommand($sql)->queryOne();
            $datas = [$data['m1'],$data['m2'],$data['m3'],$data['m4'],$data['m5'],$data['m6'],$data['m7'],$data['m8'],$data['m9'],$data['m10'],$data['m11'],$data['m12']];
            $labels = \appxq\sdii\utils\SDdate::getMonthThAll();
            $labelFull = \appxq\sdii\utils\SDdate::getMonthFull();
            $output = "";
            $output .= "<h4>".Yii::t('section','Summarize')." ".Yii::t('section','Website Traffic Statistics')."</h4>";
            $output .= "<table class='table table-bordered'>";
            $output .= "<thead><tr><th>".Yii::t('section', 'Month')."</th><th style='width:150px;text-align:center;'>".Yii::t('section','Number of visitors/Person')."</th></tr></thead>";
            foreach($labelFull as $k=>$v){  
                $k=$k+1;
                $output .= "
                    <tr>
                        <td>{$v}</td>
                        <td class='text-center'>{$data["m{$k}"]}</td>
                    </tr>                     
                ";
                
            }
            $output .= "</table>";
            
        }else{
            $labels = [\appxq\sdii\utils\SDdate::getMonthByKey($month-1)];
            $labelFull = \appxq\sdii\utils\SDdate::getMonthFullByKey($month-1);
            $output = "";
            if((int)$month < 10){
                $month = "0{$month}";
            }
            
            $sql="
                SELECT 
                (SELECT count(t1.id) FROM tbl_view as t1 WHERE t1.date BETWEEN '{$year}-00-01' AND '{$year}-$month-31') as m1
                FROM tbl_view limit 1
            ";
            $data = Yii::$app->db->createCommand($sql)->queryOne();
            $datas = [$data['m1']];
            $output .= "<h4>".Yii::t('section','Summarize')." ".Yii::t('section','Website Traffic Statistics')."</h4>";
            $output .= "เดือน <b>{$labelFull}</b> จำนวนผู้เข้าชม <b>{$data['m1']}</b> คน";
             
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$data
        ]);
        
        return $this->renderAjax('print', [ 
            'dataProvider' => $dataProvider,
            'print'=>$print,
            'labels'=>$labels,
            'datas'=>$datas,
            'output'=>$output
        ]);
    }

    /**
     * Displays a single View model.
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
     * Creates a new View model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model = new View();

	    if ($model->load(Yii::$app->request->post())) {
		Yii::$app->response->format = Response::FORMAT_JSON;
		if ($model->save()) {
		    $result = [
			'status' => 'success',
			'action' => 'create',
			'message' => SDHtml::getMsgSuccess() . Yii::t('app', 'Data completed.'),
			'data' => $model,
		    ];
		    return $result;
		} else {
		    $result = [
			'status' => 'error',
			'message' => SDHtml::getMsgError() . Yii::t('app', 'Can not create the data.'),
			'data' => $model,
		    ];
		    return $result;
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
     * Updates an existing View model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post())) {
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
     * Deletes an existing View model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    if ($this->findModel($id)->delete()) {
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
     * Finds the View model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return View the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = View::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
