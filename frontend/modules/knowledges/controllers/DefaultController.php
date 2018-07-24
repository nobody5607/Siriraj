<?php

namespace frontend\modules\knowledges\controllers;

use yii\web\Controller;
use frontend\modules\knowledges\classes\JSection;
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : 0;
        $section = JSection::getSectionByParentId($parent_id);
        $breadcrumbs = [];
        if($section && $parent_id == 0){
            //master
            $title_arr      = JSection::setTitle('', '', 'default');
            $content_all    = \frontend\modules\knowledges\classes\JContent::getContentAll();
            $breadcrumbs    = JSection::setBreadcrumbs($parent_id);           
        }else if($section && $parent_id != 0){
             
            //child
            $menu_head      = JSection::getSectionById($parent_id);//get session ที่จะแสดงบนหัว เมนู by id         
            $title_arr      = JSection::setTitle($menu_head, $section[0], '');            
            $content_all    = \frontend\modules\knowledges\classes\JContent::getContentBySectionId($parent_id);
            $breadcrumbs    = JSection::setBreadcrumbs($parent_id);//get by id
            //$content_all    = \frontend\modules\knowledges\classes\JContent::getIDContentBySectionIdAll($parent_id);
            //\appxq\sdii\utils\VarDumper::dump($content_all); 
//            
        }else if(!$section){
            //ถ้าไม่มี child ให้เอาตััวเองมาแสดง
            $section        = JSection::getSectionById($parent_id, 'all');
            $menu_head      = JSection::getSectionById($parent_id, 'one');//get session ที่จะแสดงบนหัว เมนู 
            $breadcrumbs    = JSection::setBreadcrumbs($parent_id);
            
            if(!empty($menu_head)){
                $parent_id  = $menu_head['parent_id'];
                $menu_head  = JSection::getSectionById($parent_id, 'one');//get session ที่จะแสดงบนหัว เมนู 
                $title_arr  = JSection::setTitle($menu_head, $section[0], '');
            }else{
                $title_arr  = JSection::setTitle('', '', 'default');
                //\appxq\sdii\utils\VarDumper::dump($menu_head);
            }
            
            $content_all = \frontend\modules\knowledges\classes\JContent::getContentBySectionId($parent_id);
            
        }
        $file_type = \common\models\FileType::find()->all();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$section,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        $dataProviderContent = new \yii\data\ArrayDataProvider([
            'allModels'=>$content_all,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->render('index',[
            'section'=>$section,
            'title_arr'=>$title_arr,
            'content'=>$content_all,
            'breadcrumbs'=>$breadcrumbs,
            'file_type'=>$file_type,
            'dataProvider'=>$dataProvider,
            'dataProviderContent'=>$dataProviderContent
        ]);
    }
    public function actionSort(){
        $data = isset($_GET['data']) ? $_GET['data'] : '';
        print_r($data);
        
    }
}
