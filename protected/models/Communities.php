<?php

/**
 * This is the model class for table "communities".
 *
 * The followings are the available columns in table 'communities':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property CommunityTerms[] $communityTerms
 */
class Communities extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'communities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'communityTerms' => array(self::HAS_MANY, 'CommunityTerms', 'community_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Communities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function findByName($name)
	{
		return Communities::model()->findByAttributes(array(
			'name' => $name
		));
	}

	public static function findOrCreateByName($name)
	{
		$comm = Communities::findByName($name);

		if (!isset($comm)) {
			$comm = new Communities;
			$comm->name = $name;
			$comm->save();
		}

		return $comm;
	}

	public static function getAll()
	{
		$comm_list = array();
		$communities = Communities::model()->findAll();
		foreach($communities as $community) {
			array_push($comm_list, $community->name);
		}
		return $comm_list;
	}

	public static function getAllHash()
	{
		$comm_hash = array();
		$communities = Communities::model()->findAll();
		foreach($communities as $community) {
			$comm_hash[$community->id] = $community->name;
		}
		return $comm_hash;
	}
}
