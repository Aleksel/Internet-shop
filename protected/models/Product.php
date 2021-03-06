<?php

/**
 * This is the model class for table "yii_product".
 *
 * The followings are the available columns in table 'yii_product':
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $titletranscript
 * @property string $features
 * @property integer $prise
 * @property string $urlpic
 * @property string $description
 * @property double $avg_review
 * @property integer $count_review
 *
 * The followings are the available model relations:
 * @property MainMenu $category
 * @property AvgReview[] $avgReviews
 * @property Review[] $reviews
 */
class Product extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'yii_product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('title, titletranscript', 'required'),
	    array('category_id, prise, count_review', 'numerical', 'integerOnly' => true),
	    array('avg_review', 'numerical'),
	    array('title, titletranscript, features, urlpic', 'length', 'max' => 255),
	    array('description', 'safe'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, category_id, title, titletranscript, features, prise, urlpic, description, avg_review, count_review', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'category' => array(self::BELONGS_TO, 'Main_Menu', 'category_id'),
	    'avgReviews' => array(self::HAS_MANY, 'AvgReview', 'product_id'),
	    'reviews' => array(self::HAS_MANY, 'Review', 'product_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'category_id' => 'Category',
	    'title' => 'Title',
	    'titletranscript' => 'Titletranscript',
	    'features' => 'Features',
	    'prise' => 'Prise',
	    'urlpic' => 'Urlpic',
	    'description' => 'Description',
	    'avg_review' => 'Avg Review',
	    'count_review' => 'Count Review',
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
	$criteria->compare('category_id', $this->category_id);
	$criteria->compare('title', $this->title, true);
	$criteria->compare('titletranscript', $this->titletranscript, true);
	$criteria->compare('features', $this->features, true);
	$criteria->compare('prise', $this->prise);
	$criteria->compare('urlpic', $this->urlpic, true);
	$criteria->compare('description', $this->description, true);
	$criteria->compare('avg_review', $this->avg_review);
	$criteria->compare('count_review', $this->count_review);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

}

