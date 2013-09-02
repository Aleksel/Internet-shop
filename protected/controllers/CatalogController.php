<?php

class CatalogController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionDog($area='', $item='')
	{
                        Yii::app()->params['area']=$area;
                        //Выбираем view в зависимости от переданного в url параметра @area
                        switch ($area){
                            case 'cages':$this->render('catalog2',array(
                                'area'=>$area,
                            ));
                            break;
                            case 'lies':$this->render('catalog',array(
                                'area'=>$area,
                            ));
                            break;
                            default :$this->render('catalog',array(
                                'area'=>$area,
                            ));
                        }

	}
	public function actionCages()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('catalog2');
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}