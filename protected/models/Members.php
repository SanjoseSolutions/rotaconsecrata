<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $id
 * @property string $fullname
 * @property string $photo
 * @property string $maiden_name
 * @property string $mobile
 * @property string $dob
 * @property string $joining_dt
 * @property string $vestation_dt
 * @property string $first_commitment_dt
 * @property string $final_commitment_dt
 * @property string $fathers_name
 * @property string $mothers_name
 * @property integer $father_alive
 * @property integer $mother_alive
 * @property string $address
 * @property string $home_phone
 * @property string $home_mobile
 * @property string $parish
 * @property string $diocese
 * @property string $demise_dt
 * @property string $leaving_dt
 * @property integer $mission
 * @property integer $generalate
 * @property integer $community
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $swiss_visit
 * @property integer $holyland_visit
 * @property integer $family_abroad
 */
class Members extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullname, dob, joining_dt, fathers_name, mothers_name', 'required'),
			array('father_alive, mother_alive, mission, generalate, community, updated_by, swiss_visit, holyland_visit, family_abroad', 'numerical', 'integerOnly'=>true),
			array('fullname, maiden_name, fathers_name, mothers_name', 'length', 'max'=>100),
			array('photo, parish', 'length', 'max'=>50),
			array('mobile, home_phone, home_mobile', 'length', 'max'=>15),
			array('diocese', 'length', 'max'=>30),
			array('vestation_dt, first_commitment_dt, final_commitment_dt, address, demise_dt, leaving_dt, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fullname, photo, maiden_name, mobile, dob, joining_dt, vestation_dt, first_commitment_dt, final_commitment_dt, fathers_name, mothers_name, father_alive, mother_alive, address, home_phone, home_mobile, parish, diocese, demise_dt, leaving_dt, mission, generalate, community, updated_by, updated_on, swiss_visit, holyland_visit, family_abroad', 'safe', 'on'=>'search'),
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
			'fullname' => 'Fullname',
			'photo' => 'Photo',
			'maiden_name' => 'Maiden Name',
			'mobile' => 'Mobile',
			'dob' => 'Date of Birth',
			'joining_dt' => 'Joining Date',
			'vestation_dt' => 'Vestation Date',
			'first_commitment_dt' => 'First Commitment Date',
			'final_commitment_dt' => 'Final Commitment Date',
			'fathers_name' => 'Fathers Name',
			'mothers_name' => 'Mothers Name',
			'father_alive' => 'Father Alive',
			'mother_alive' => 'Mother Alive',
			'address' => 'Address',
			'home_phone' => 'Home Phone',
			'home_mobile' => 'Home Mobile',
			'parish' => 'Parish',
			'diocese' => 'Diocese',
			'demise_dt' => 'Demise Date',
			'leaving_dt' => 'Leaving Date',
			'mission' => 'Mission',
			'generalate' => 'Generalate',
			'community' => 'Community',
			'updated_by' => 'Updated By',
			'updated_on' => 'Updated On',
			'swiss_visit' => 'Swiss Visit',
			'holyland_visit' => 'Holyland Visit',
			'family_abroad' => 'Family Abroad',
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
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('maiden_name',$this->maiden_name,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('joining_dt',$this->joining_dt,true);
		$criteria->compare('vestation_dt',$this->vestation_dt,true);
		$criteria->compare('first_commitment_dt',$this->first_commitment_dt,true);
		$criteria->compare('final_commitment_dt',$this->final_commitment_dt,true);
		$criteria->compare('fathers_name',$this->fathers_name,true);
		$criteria->compare('mothers_name',$this->mothers_name,true);
		$criteria->compare('father_alive',$this->father_alive);
		$criteria->compare('mother_alive',$this->mother_alive);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('home_mobile',$this->home_mobile,true);
		$criteria->compare('parish',$this->parish,true);
		$criteria->compare('diocese',$this->diocese,true);
		$criteria->compare('demise_dt',$this->demise_dt,true);
		$criteria->compare('leaving_dt',$this->leaving_dt,true);
		$criteria->compare('mission',$this->mission);
		$criteria->compare('generalate',$this->generalate);
		$criteria->compare('community',$this->community);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('swiss_visit',$this->swiss_visit);
		$criteria->compare('holyland_visit',$this->holyland_visit);
		$criteria->compare('family_abroad',$this->family_abroad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Members the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
