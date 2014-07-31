<?php

/**
 * This is the model class for table "travels".
 *
 * The followings are the available columns in table 'travels':
 * @property integer $id
 * @property integer $year
 * @property string $places
 * @property string $nature
 * @property integer $member_id
 *
 * The followings are the available model relations:
 * @property Members $member
 */
class Travels extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'travels';
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
			array('places', 'length', 'max'=>100),
			array('nature', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, year, places, nature, member_id', 'safe', 'on'=>'search'),
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
			'year' => 'Year',
			'places' => 'Places',
			'nature' => 'Nature',
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
		$criteria->compare('year',$this->year);
		$criteria->compare('places',$this->places,true);
		$criteria->compare('nature',$this->nature,true);
		$criteria->compare('member_id',$this->member_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Travels the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
