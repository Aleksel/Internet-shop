<?php

class MainMenu extends CMenu {

    private $url;

    public function init() {
	//Текущий контроллер
	$controller = Yii::app()->controller->id;
	//Текущий экшин
	$action = Yii::app()->controller->action->id;
	//Переданный параметр в урл
	$view = Yii::app()->params['area'];
	$menu = array();
	//Получаем список всех пунктов меню
	foreach (MenuTree::model()->findAll(array('order' => 'parent_id, id')) as $item) {

	    //Проверяем что запись не подпунк
	    if (0 == $item->parent_id) {
		//Если текущий контроллер, экшин и переданный в урл параметр равен полученному из базы, то присваиваем
		//активный класс для текущего пункта в массив menu
		if (($controller === $item->controller) and ($action === $item->action) and ($view === $item->view)) {
		    $menu[$item->id][active] = true;
		}
		//Присваиваем название пункта и его адрес в массив menu
		$menu[$item->id][label] = $item->title;
		//Формируем адрес из урла и гет запроса и присваиваем в массив menu
		$menu[$item->id][url] = $item->url;
	    }
	    //Проверяем является ли запись подпунктом
	    else {
		//Если текущий контроллер, экшин и переданный в урл параметр равен полученному из базы, то присваиваем
		//активный класс для текущего подпункта и его родителя в массив menu
		if (($controller === $item->controller) and ($action === $item->action) and ($view === $item->view)) {
		    $menu[$item->parent_id]['items'][$item->id][active] = true;
		    $menu[$item->parent_id][active] = true;
		}
		//Присваиваем название подпункта в массив menu
		$menu[$item->parent_id]['items'][$item->id][label] = $item->title;
		//Формируем адрес из урла и гет запроса и присваиваем в массив menu
		$menu[$item->parent_id]['items'][$item->id][url] = $item->url;
		//Отображаем подпункты только если текущий контроллер - catalog
		$menu[$item->parent_id]['items'][$item->id][visible] = Yii::app()->controller->id == 'catalog';
	    }
	}
	$this->items = $menu;
	parent::init();
    }

}

