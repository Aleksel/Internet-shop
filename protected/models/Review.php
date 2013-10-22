<?php

/**
 * This is the model class for table "yii_review".
 *
 * The followings are the available columns in table 'yii_review':
 * @property integer $id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $assess
 * @property string $title
 * @property string $value
 * @property string $limitations
 * @property string $comments
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Users $user
 * @property MainMenu $category
 */
class Review extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'yii_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('assess, title, timestamp', 'required'),
	    array('product_id, user_id, category_id, assess, timestamp', 'numerical', 'integerOnly' => true),
	    array('title', 'length', 'max' => 255),
	    array('value, limitations, comments', 'safe'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, product_id, user_id, category_id, assess, title, value, limitations, comments, timestamp', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
	    'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
	    'category' => array(self::BELONGS_TO, 'Main_Menu', 'category_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'product_id' => 'Product',
	    'user_id' => 'User',
	    'category_id' => 'Category',
	    'assess' => 'Assess',
	    'title' => 'Title',
	    'value' => 'Value',
	    'limitations' => 'Limitations',
	    'comments' => 'Comments',
	    'timestamp' => 'Timestamp',
	);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
	// Warning: Please modify the following code to remove attributes that
	// should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id);
	$criteria->compare('product_id', $this->product_id);
	$criteria->compare('user_id', $this->user_id);
	$criteria->compare('category_id', $this->category_id);
	$criteria->compare('assess', $this->assess);
	$criteria->compare('title', $this->title, true);
	$criteria->compare('value', $this->value, true);
	$criteria->compare('limitations', $this->limitations, true);
	$criteria->compare('comments', $this->comments, true);
	$criteria->compare('timestamp', $this->timestamp);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

}

