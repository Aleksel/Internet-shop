<?php

class MainMenu extends CMenu {

    private $url;

    public function init() {

	//Текущий экшин
	$action = Yii::app()->params['action'];

	//Переданный параметр в урл
	$view = Yii::app()->params['area'];
	$menu = array();

	//Получаем список всех основных пунктов меню
	$items = Yii::app()->db->createCommand()
		->from('yii_main_menu')
		->where('parent_id = 0')
		->order('ordercat')
		->queryAll();
	//$items = MenuTree::model()->findAll(array('order' => 'ordercat'));

	foreach ($items as $item) {

	    //Если текущий экшин равен полученным из базы и view не задан, то присваиваем
	    //активный класс для текущего пункта в массив menu
	    if ($action === $item['action'] and $view === '') {
		$menu[$item['id']]['active'] = true;
	    }

	    //Присваиваем название пункта и его адрес в массив menu
	    $menu[$item['id']]['label'] = $item['title'];
	    $menu[$item['id']]['url'] = $item['url'];

	    //Если текущий экшин из базы и переданный в урл параметр
	    //равены, то получаем подпункты из базы
	    if ($action === $item['action']) {

		$podItems = Yii::app()->db->createCommand()
			->from('yii_main_menu')
			->where('parent_id =:itemId  and action=:action', array(':itemId' => $item[id], ':action' => $action))
			->order('ordercat')
			->queryAll();

		foreach ($podItems as $podItem) {

		    //Присваиваем название подпункта и его адрес в массив menu
		    $menu[$item[id]]['items'][$podItem['id']]['label'] = $podItem['title'];
		    $menu[$item[id]]['items'][$podItem['id']]['url'] = $podItem['url'];

		    //Если переданый в урл второй параметр равен полученому из базы
		    //присваиваем активный класс
		    if ($action === $podItem['action'] and
			    $view === $podItem['view']) {

			$menu[$item['id']]['items'][$podItem['id']]['active'] = true;
			$menu[$item['id']]['active'] = true;
		    }
		}
	    }
	}
	$this->items = $menu;
	$this->id = 'menuVerUl';
	parent::init();
    }

}

