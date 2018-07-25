<?php
namespace common\modules\cores;
use Yii;
class User {
    public static function getProfileName(){
        $fname = isset(Yii::$app->user->identity->userProfile->firstname) ? Yii::$app->user->identity->userProfile->firstname : '';
        $lname = isset(Yii::$app->user->identity->userProfile->lastname) ? Yii::$app->user->identity->userProfile->lastname : '';
        return "{$fname} {$lname}";
    }
}
