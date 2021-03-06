<?php

/**
 * This is the model class for table "renewals".
 *
 * The followings are the available columns in table 'renewals':
 * @property integer $id
 * @property string $renewal_dt
 * @property string $place
 * @property integer $member_id
 *
 * The followings are the available model relations:
 * @property Members $member
 */
class Renewals extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'renewals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('renewal_dt, member_id', 'required'),
			array('member_id', 'numerical', 'integerOnly'=>true),
			array('place', 'length', 'max'=>75),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, renewal_dt, place, member_id', 'safe', 'on'=>'search'),
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
			'renewal_dt' => 'Renewal Date',
			'place' => 'Place',
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
		$criteria->compare('renewal_dt',$this->renewal_dt,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('member_id',$this->member_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Renewals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
}
