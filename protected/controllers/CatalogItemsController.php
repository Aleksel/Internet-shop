<?php

class CatalogItemsController extends Controller {

    public function actionIndex($action, $area = '') {

	/* $items = Yii::app()->db->createCommand()
	  ->from('yii_product')
	  ->where('category_id = (SELECT id FROM yii_main_menu WHERE parent_id > 0 and action=:action and view=:view)', array(':action' => $action, ':view' => $area))
	  ->queryAll(); */


	$category_id = MenuTree::model()->findAll(array(
	    'condition' => 'parent_id > 0 and action=:action and view=:view',
	    'params' => array(
		':action' => $action,
		':view' => $area)
	));

	$category_id = $category_id[0]->id;


	$criteria = new CDbCriteria(array(
	    'condition' => 'category_id=:category_id',
	    'params' => array(
		':category_id' => $category_id,
	    )
	));

	$pages = new CPagination(Product::model()->count($criteria));
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
	);

	$sort->applyOrder($criteria);

	$items = Product::model()->findAll($criteria);

	Yii::app()->params['area'] = $area;
	Yii::app()->params['action'] = $action;

	$this->render('index', array(
	    'action' => $action,
	    'view' => $view,
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

