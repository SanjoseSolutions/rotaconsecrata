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
 * @property string $email
 * @property string $dob
 * @property string $joining_dt
 * @property string $vestition_dt
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
 * @property string $edu_joining
 * @property string $edu_present
 * @property integer $mission
 * @property integer $generalate
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $swiss_visit
 * @property integer $holyland_visit
 * @property integer $family_abroad
 * @property integer $annual_checkups
 * @property string $health_data
 *
 * The followings are the available model relations:
 * @property MemberSpecializations[] $memberSpecs
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
			array('father_alive, mother_alive, mission, generalate, community, updated_by, swiss_visit, holyland_visit, family_abroad, annual_checkups', 'numerical', 'integerOnly'=>true),
			array('fullname, maiden_name, fathers_name, mothers_name', 'length', 'max'=>100),
			array('photo, email, parish, edu_joining, edu_present', 'length', 'max'=>50),
			array('mobile, home_phone, home_mobile', 'length', 'max'=>15),
			array('diocese', 'length', 'max'=>30),
			array('vestition_dt, first_commitment_dt, final_commitment_dt, address, health_data, demise_dt, leaving_dt, updated_on', 'safe'),
			array('dob, vestition_dt, first_commitment_dt, final_commitment_dt, demise_dt, leaving_dt, updated_on, made_final, father_alive, mother_alive', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fullname, age, maiden_name, made_final, mobile, dob, joining_dt, vestition_dt, ' .
				'first_commitment_dt, final_commitment_dt, made_final, fathers_name, mothers_name, ' .
				'father_alive, mother_alive, address, home_phone, home_mobile, parish, diocese, ' .
				'demise_dt, leaving_dt, mission, generalate, community, updated_by, updated_on, ' .
				'swiss_visit, holyland_visit, family_abroad, specialization, education, ' .
				'current_community, current_designation, bday_from, bday_to', 'safe', 'on'=>'search'),
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
			'academicCourses' => array(self::HAS_MANY, 'AcademicCourses', 'member_id'),
			'memberSpecs' => array(self::HAS_MANY, 'MemberSpecializations', 'member_id'),
			'siblings' => array(self::HAS_MANY, 'Siblings', 'member_id'),
			'communityTerms' => array(self::HAS_MANY, 'CommunityTerms', 'member_id'),
			'renewalCoursesSpiritual' => array(self::HAS_MANY, 'RenewalCoursesSpiritual', 'member_id'),
			'renewalCoursesProfessional' => array(self::HAS_MANY, 'RenewalCoursesProfessional', 'member_id'),
			'renewals' => array(self::HAS_MANY, 'Renewals', 'member_id'),
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
			'email' => 'Email',
			'dob' => 'Date of Birth',
			'age' => 'Age',
			'bday_from' => 'Birthday From',
			'bday_to' => 'Birthday To',
			'joining_dt' => 'Joining Date',
			'vestition_dt' => 'Vestition Date',
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
			'edu_joining' => 'Education when Joining',
			'edu_present' => 'Education at Present',
			'mission' => 'Opted for Mission',
			'generalate' => 'Under Generalate',
			'community' => 'Community',
			'current_community' => 'Current Community',
			'current_designation' => 'Current Designation',
			'updated_by' => 'Updated By',
			'updated_on' => 'Updated On',
			'swiss_visit' => 'Swiss Visit',
			'holyland_visit' => 'Holyland Visit',
			'family_abroad' => 'Family Abroad',
			'annual_checkups' => 'Annual Checkups',
			'health_data' => 'Health Data',
		);
	}

        protected function date_search($criteria, $dt_col, $yr_col) { 
                $yr_val = $this->$yr_col;
                if (preg_match('/^(\d+)-(\d+)$/', $yr_val, $matches) or preg_match('/^(\d+)\.\.(\d+)$/', $yr_val, $matches)) {
                        $lim_max = "" . (date_format(new DateTime('now'), 'Y') - $matches[1])
                                                . date_format(new DateTime('now'), '-m-d');
                        $lim_min = "" . (date_format(new DateTime('now'), 'Y') - $matches[2] - 1)
                                                . date_format(new DateTime('now'), '-m-d');
                        $criteria = $criteria->addCondition("$dt_col between '$lim_min' and '$lim_max'");
                } elseif (preg_match('/^(>|<|<=|>=|<>)(\d+)$/', $yr_val, $matches)) {
                        if (preg_match('/^[<=]+$/', $matches[1])) {
                                $sgn = preg_replace('/</', '>', $matches[1]);
                        } elseif (preg_match('/^[>=]+$/', $matches[1])) {
                                $sgn = preg_replace('/>/', '<', $matches[1]);
                        } else {
                                $sgn = $matches[1];
                        }

                        $lim = "" . (date_format(new DateTime('now'), 'Y') - $matches[2])
                                                . date_format(new DateTime('now'), '-m-d');
                        $criteria = $criteria->addCondition("$dt_col $sgn '$lim'");
                } elseif (preg_match('/^(\d+)$/', $yr_val, $matches)) {
                        $lim_max = "" . (date_format(new DateTime('now'), 'Y') - $matches[1])
                                                . date_format(new DateTime('now'), '-m-d');
                        $lim_min = "" . (date_format(new DateTime('now'), 'Y') - $matches[1] - 1)
                                                . date_format(new DateTime('now'), '-m-d');
                        $criteria = $criteria->addCondition("$dt_col between '$lim_min' and '$lim_max'");
                }
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dob',$this->dob,true);
                if (isset($this->age)) {
                        $this->date_search($criteria, 'dob', 'age');
                }
		if (isset($this->joining_dt) and $this->joining_dt) {
			$this->joining_dt = FormatHelper::dateConvDB(
				$this->joining_dt, Yii::app()->locale->getDateFormat('short'));
			$criteria->compare('joining_dt',$this->joining_dt,true);
		}
		if (isset($this->vestition_dt) and $this->vestition_dt) {
			$this->vestition_dt = FormatHelper::dateConvDB(
				$this->vestition_dt, Yii::app()->locale->getDateFormat('short'));
			$criteria->compare('vestition_dt',$this->vestition_dt,true);
		}
		if (isset($this->first_commitment_dt) and $this->first_commitment_dt) {
			$this->first_commitment_dt = FormatHelper::dateConvDB(
				$this->first_commitment_dt, Yii::app()->locale->getDateFormat('short'));
			$criteria->compare('first_commitment_dt',$this->first_commitment_dt,true);
		}
		if (isset($this->final_commitment_dt) and $this->final_commitment_dt) {
			$this->final_commitment_dt = FormatHelper::dateConvDB(
				$this->final_commitment_dt, Yii::app()->locale->getDateFormat('short'));
			$criteria->compare('final_commitment_dt',$this->final_commitment_dt,true);
		}
		if (isset($this->made_final)) {
			switch ($this->made_final) {
				case 0: $cond = "IS"; break;
				case 1: $cond = "IS NOT"; break;
			}
			$criteria = $criteria->addCondition("final_commitment_dt $cond NULL");
		}
		if (isset($this->specialization) and $this->specialization) {
			$criteria->mergeWith(array(
				'join' => 'INNER JOIN member_spec m ON m.member_id = t.id',
				'condition' => 'm.spec_id = ' . $this->specialization,
			));
		}
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
		$criteria->compare('edu_joining',$this->edu_joining,true);
		$criteria->compare('edu_present',$this->edu_present,true);
		$criteria->compare('mission',$this->mission);
		$criteria->compare('generalate',$this->generalate);
		if (isset($this->community) and $this->community) {
			$criteria = $criteria->addCondition("EXISTS (SELECT id FROM community_terms c " .
				"WHERE c.member_id = t.id AND c.community_id = " . $this->community . ")");
		}
		if (isset($this->current_community) and $this->current_community) { 
			$criteria = $criteria->addCondition("EXISTS (SELECT id FROM community_terms c " .
				"WHERE c.member_id = t.id AND c.year_to IS NULL " .
				"AND c.community_id = " . $this->current_community . ")");
		}
		if (isset($this->current_designation) and $this->current_designation) { 
			$criteria = $criteria->addCondition("EXISTS (SELECT id FROM community_terms c " .
				"WHERE c.member_id = t.id AND c.year_to IS NULL " .
				"AND c.designation LIKE '%" . $this->current_designation . "%')");
		}
		if (isset($this->bday_from) and $this->bday_from and
				isset($this->bday_to) and $this->bday_to) {
			$dt = FormatHelper::dateConvDB(
			    	$this->bday_from, Yii::app()->locale->getDateFormat('short'));
			$nxt_bday = "MAKEDATE(YEAR('$dt')+IF(DAYOFYEAR(t.dob)<DAYOFYEAR('$dt'),1,0),DAYOFYEAR(t.dob))";
			$to_dt = FormatHelper::dateConvDB(
			    	$this->bday_to, Yii::app()->locale->getDateFormat('short'));
			$criteria = $criteria->addCondition("$nxt_bday BETWEEN '$dt' AND '$to_dt' ORDER BY $nxt_bday");
		}
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('swiss_visit',$this->swiss_visit);
		$criteria->compare('holyland_visit',$this->holyland_visit);
		$criteria->compare('family_abroad',$this->family_abroad);
		$criteria->compare('annual_checkups',$this->annual_checkups);
		$criteria->compare('health_data',$this->health_data);
		if (isset($this->education) and $this->education) {
			$criteria = $criteria->addCondition("EXISTS (SELECT id FROM academic_courses c " .
				"WHERE c.member_id = t.id AND c.name LIKE '%" . $this->education . "%')");
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        protected function beforeSave()
        {
            if(parent::beforeSave())
            {
                // Format dates based on the locale
                foreach($this->metadata->tableSchema->columns as $columnName => $column)
                {
                    if ($column->dbType == 'date' and isset($this->$columnName) and $this->$columnName)
                    {
			    $this->$columnName = FormatHelper::dateConvDB(
			    	$this->$columnName, Yii::app()->locale->getDateFormat('short'));
		    }
		}
		return true;
	    } else return false;
	}

        protected function afterFind()
        {
            // Format dates based on the locale
            foreach($this->metadata->tableSchema->columns as $columnName => $column)
            { 
                if (!strlen($this->$columnName)) continue;

                if ($column->dbType == 'date')
                { 
                        $this->$columnName = FormatHelper::dateConvView(
                                $this->$columnName,
                                Yii::app()->locale->getDateFormat('short')
                        );
                }
            }
            return parent::afterFind();
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

        public function getAge() {
                return $this->dob ? (strtotime('now') - strtotime($this->dob)) / (60*60*24*365.2425) : null;
        }

        public function setAge($val) {
                $this->age = $val;
        }

        public function getMade_final() {
                return isset($this->made_final) ? $this->made_final : null;
        }

        public function setMade_final($val) {
		if ($val == null) return;
                $this->made_final = $val;
        }

        public function getProfessed() {
                return $this->first_commitment_dt ? (strtotime('now') - strtotime($this->first_commitment_dt)) / (60*60*24*365.2425) : null;
        }

	public function setCommunity($val) {
		$this->_community = $val;
	}

	public function getCommunity() {
		return isset($this->_community) ? $this->_community : null;
	}

	public function getPresentCommunity() {
		$mid = $this->id;
		return CommunityTerms::model()->find("member_id = $mid AND year_to IS NULL");
	}

	public function setSpecialization($val) {
		$this->specialization = $val;
	}

	public function getSpecialization() {
		return isset($this->specialization) ? $this->specialization : null;
	}

	private $_community;

	public $current_community;
	public $current_designation;
	public $bday_from;
	public $bday_to;
	public $education;
}
