<?php

/**
 * This is the model class for table "yii_main_menu".
 *
 * The followings are the available columns in table 'yii_main_menu':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $action
 * @property string $view
 * @property string $url
 * @property string $urlPic
 * @property integer $orderCat
 */
class MenuTree extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuTree the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_main_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, title, action, orderCat', 'required'),
			array('parent_id, orderCat', 'numerical', 'integerOnly'=>true),
			array('title, url, urlPic', 'length', 'max'=>255),
			array('action, view', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, title, action, view, url, urlPic, orderCat', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'title' => 'Title',
			'action' => 'Action',
			'view' => 'View',
			'url' => 'Url',
			'urlPic' => 'Url Pic',
			'orderCat' => 'Order Cat',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('view',$this->view,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('urlPic',$this->urlPic,true);
		$criteria->compare('orderCat',$this->orderCat);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}