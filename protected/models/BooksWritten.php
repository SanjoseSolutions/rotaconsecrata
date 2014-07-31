<?php

/**
 * This is the model class for table "books_written".
 *
 * The followings are the available columns in table 'books_written':
 * @property integer $id
 * @property string $authors
 * @property integer $year
 * @property string $title
 * @property string $publisher
 * @property integer $member_id
 *
 * The followings are the available model relations:
 * @property Members $member
 */
class BooksWritten extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books_written';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id', 'required'),
			array('year, member_id', 'numerical', 'integerOnly'=>true),
			array('authors', 'length', 'max'=>150),
			array('title, publisher', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, authors, year, title, publisher, member_id', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'Members', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'authors' => 'Authors',
			'year' => 'Year',
			'title' => 'Title',
			'publisher' => 'Publisher',
			'member_id' => 'Member',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('authors',$this->authors,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('member_id',$this->member_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BooksWritten the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
