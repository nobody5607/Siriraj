<?php
namespace janpan\jn\widgets;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
class BreadcrumbsWidget extends \yii\base\Widget{ 
    public $breadcrumb = [];
    public function run()
    {   
         
        $this->registerAssets();
        $this->registerCss();
        $html = "";
        $html .= Html::beginTag("nav");
        $html .= Html::beginTag("ol",['class'=>'cd-breadcrumb custom-separator']);
            foreach($this->breadcrumb as $k=>$v){
                $icon = isset($v['icon']) ? $v['icon'] : '';
                $label = isset($v['label']) ? $v['label'] : '';
                $url = isset($v['url']) ? $v['url'] : '';
                $id = isset($v['url']['id']) ? $v['url']['id'] : '';
                $html .= Html::beginTag("li");
                    if(!empty($v['url'])){
                        if(!empty($v['url']['id'])){                            
                            $html .= Html::a("<i class='fa {$icon}'></i> {$label}", ["{$url[0]}?id={$id}"], ['']);
                        }else{
                            $url = isset($url) ? $url[0] : '';
                            $html .= Html::a("<i class='fa {$icon}'></i> {$label}", ["{$url}"], ['']);
                            //\appxq\sdii\utils\VarDumper::dump($url);
                        }                        
                    }else{
                        $html .= Html::a("<i class='fa {$icon}'></i> {$label}", "#", ['']);
                    }
                    
                $html .= Html::endTag("li"); 
            }             
               
        $html .= Html::endTag("ol");
        $html .= Html::endTag("nav");
        echo $html;
    }
    public function registerAssets(){
        $view = $this->getView();
        \janpan\jn\assets\BreadcrumbsAssets::register($view);
    }
    public function registerCss(){
        $view= $this->getView();
        $css="
         @media only screen and (min-width: 768px){
            .cd-breadcrumb li > *, .cd-multi-steps li > * {
                font-size: 14px;
            }
            section {
                padding: 0em 0;
            }
            .cd-breadcrumb, .cd-multi-steps{
                padding: 0 3.2em;
            }
            .cd-breadcrumb, .cd-multi-steps {
                width: 100%;
                max-width: 81%;
                padding: 0em 1em;
                margin: 1em auto;
                background-color: #f8f8f8;
                border-radius: .25em;
                margin-left: 245px;
                border: 1px solid #e7e7e7;
            }
            .cd-breadcrumb li, .cd-multi-steps li{
                margin: 0.5em 0;
            }
        }   
        ";
        $view->registerCss($css);

    } 
}
