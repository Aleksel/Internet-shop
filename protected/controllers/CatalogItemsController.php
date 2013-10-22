<?php

class CatalogItemsController extends Controller {

    public function actionIndex($action, $area = '') {

	Yii::app()->params['area'] = $area;
	Yii::app()->params['action'] = $action;

	//Получаем id категории, в которую переходим
	$category_id = Main_Menu::model()->findAll(array(
	    'condition' => 'parent_id > 0 and action=:action and view=:view',
	    'params' => array(
		':action' => $action,
		':view' => $area)
	));

	$category_id = $category_id[0]->id;

	//Создаем объекты для постраничной навигации и сортировке
	$criteria = new CDbCriteria(array(
	    'condition' => 't.category_id=:category_id',
	    'params' => array(
		':category_id' => $category_id,
	    )
	));

	$pages = new CPagination(Product::model()->count($criteria));

	//Получаем настройку из базы с кол-вом вывода товаров на экран
	$count_items_on_page = Yii::app()->db->createCommand()
		->from('yii_settings')
		->where('setting_name=:count', array(':count' => 'count_items_on_page'))
		->queryAll();

	$pages->pageSize = $count_items_on_page[0]['param'];
	$pages->applyLimit($criteria);

	$sort = new MyCSort('Product');

	$sort->attributes = array(
	    'prise',
	    'title',
	    'avg_review',
	);

	$sort->applyOrder($criteria);

	$items = Product::model()->findAll($criteria);

	/* $message = new YiiMailMessage;
	  $message->setBody('<q>Here is the message itself</q>', 'text/html');
	  $message->subject = 'My Subject';
	  $message->addTo('omatic2001@mail.ru');
	  $message->from = Yii::app()->params['adminEmail'];
	  Yii::app()->mail->send($message); */

	$this->render('index', array(
	    'action' => $action,
	    'items' => $items,
	    'pages' => $pages,
	    'sort' => $sort,
	));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}

