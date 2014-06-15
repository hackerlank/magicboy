<?php

/**
 * This is the model class for table "card_3".
 *
 * The followings are the available columns in table 'card_3':
 * @property string $seq
 * @property string $uid
 * @property string $ip
 * @property string $prop_time
 * @property string $drink_time
 * @property string $drink_operator_id
 */
class Card3 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Card3 the static model class
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
		return 'card_3';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prop_time, drink_time', 'required'),
			array('seq, ip', 'length', 'max'=>16),
			array('uid', 'length', 'max'=>64),
			array('drink_operator_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('seq, uid, ip, prop_time, drink_time, drink_operator_id', 'safe', 'on'=>'search'),
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
			'seq' => 'Seq',
			'uid' => 'Uid',
			'ip' => 'Ip',
			'prop_time' => 'Prop Time',
			'drink_time' => 'Drink Time',
			'drink_operator_id' => 'Drink Operator',
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

		$criteria->compare('seq',$this->seq,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('prop_time',$this->prop_time,true);
		$criteria->compare('drink_time',$this->drink_time,true);
		$criteria->compare('drink_operator_id',$this->drink_operator_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUsed(){
		$criteria = new CDbCriteria;
		$criteria->condition = "prop_time!=0";
		$prop = $this->count($criteria);

		$criteria->condition = "drink_time!=0";
		$drink = $this->count($criteria);

		return array('prop'=>$prop, 'drink'=>$drink);
	}
}