<?php
namespace janpan\jn\classes;
use Yii;
class JResponse {
    public static function init(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
    
    /**
     * 
     * @param type $message string message
     * @param type $model object or array  
     * @param type $action string 'CRUD'
     */
    public static function getSuccess($message, $model="", $action=''){
        self::init();
        $result = [
            'status' => 'success',
            'action' => "{$action}",
            'message' => "<strong><i class='glyphicon glyphicon-ok-sign'></i> Success!</strong> {$message}",
            'data' => $model,
        ];
        return $result;
    }
    /**
     * 
     * @param type $message string message
     * @param type $model object or array  
     * @param type $action string 'CRUD'
     */
    public static function getError($message , $model="", $action=""){
        self::init();
        $result = [
            'status' => 'error',
            'message' => "<strong><i class='glyphicon glyphicon-warning-sign'></i> Error!</strong> {$message}",
            'data' => $model,
        ];
        return $result;
    }
}
