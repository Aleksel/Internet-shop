<?php

class Banner extends CWidget {
    
    function run(){
        
        $banners = MBanner::model()->findAll(array(
            'order' => 'id ASC',
        ));
        
        //Подключаем наш скрипт
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/classic/js/slider.js");
        $this->render('banner',array('banners'=>$banners));
    }
    
    
}