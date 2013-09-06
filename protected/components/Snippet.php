<?php

class Snippet extends CWidget {

    function run() {
	//Текущий контроллер
	$controller = Yii::app()->controller->id;
	//Текущий акшин
	$action = Yii::app()->controller->action->id;
	//Переданный параметр в урл, если не передан то пустая строка
	if (!isset(Yii::app()->params['area']))
	    $view = '';
	else
	    $view = Yii::app()->params['area'];

	//Выбираем сниппет для текущего сочетания контроллера акшина и переданного в урл view
	$snippet = Yii::app()->db->createCommand()
		->from('yii_snippets')
		->where('controller=:controller and action=:action and view=:view', array(':controller' => $controller, ':action' => $action, ':view' => $view))
		->queryAll();

	$this->render('snippet', array(
	    'snippet' => $snippet
	));
    }

}

