<?php

/**
 * This is the model class for table "field_values".
 *
 * The followings are the available columns in table 'field_values':
 * @property integer $id
 * @property integer $field_id
 * @property string $value
 * @property string $descr
 * @property integer $code
 * @property integer $pos
 *
 * The followings are the available model relations:
 * @property FieldNames $field
 * @property SpokenLangs[] $spokenLangs
 */
class FieldValues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'field_values';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('field_id, value', 'required'),
			array('field_id, code, pos', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>50),
			array('descr', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, field_id, value, descr, code, pos', 'safe', 'on'=>'search'),
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
			'field' => array(self::BELONGS_TO, 'FieldNames', 'field_id'),
			'spokenLangs' => array(self::HAS_MANY, 'SpokenLangs', 'lang_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'field_id' => 'Field',
			'value' => 'Value',
			'descr' => 'Descr',
			'code' => 'Code',
			'pos' => 'Pos',
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
		$criteria->compare('field_id',$this->field_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('descr',$this->descr,true);
		$criteria->compare('code',$this->code);
		$criteria->compare('pos',$this->pos);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FieldValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function value($id) {
		return self::model()->find($id)->value;
	}
}
