<?php

/**
 * This is the model class for table "yii_settings".
 *
 * The followings are the available columns in table 'yii_settings':
 * @property integer $id
 * @property string $realm
 * @property string $setting_name
 * @property string $param
 */
class Settings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
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
		return 'yii_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('setting_name, param', 'required'),
			array('realm', 'length', 'max'=>200),
			array('setting_name', 'length', 'max'=>100),
			array('param', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, realm, setting_name, param', 'safe', 'on'=>'search'),
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
			'realm' => 'Realm',
			'setting_name' => 'Setting Name',
			'param' => 'Param',
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
		$criteria->compare('realm',$this->realm,true);
		$criteria->compare('setting_name',$this->setting_name,true);
		$criteria->compare('param',$this->param,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}