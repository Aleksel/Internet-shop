<?php

class CatalogController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($action, $area = '') {

	Yii::app()->params['area'] = $area;
	Yii::app()->params['action'] = $action;

	//Используем ту же таблицу, что и для главного меню, берем из нее разделы
	$items = Yii::app()->db->createCommand()
		->from('yii_main_menu')
		->where('parent_id > 0 and action=:action', array(':action' => $action))
		->order('ordercat')
		->queryAll();

	//Отрисовываем список всех подразделов
	$this->render('index', array(
	    'items' => $items,
	    'action' => $action,
	));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
	if ($error = Yii::app()->errorHandler->error) {
	    if (Yii::app()->request->isAjaxRequest)
		echo $error['message'];
	    else
		$this->render('error', $error);
	}
    }

}
