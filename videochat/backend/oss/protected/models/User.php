<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $uid
 * @property string $privilege
 * @property string $time
 * @property string $score
 * @property string $face_id
 * @property string $level
 * @property string $nick
 * @property string $area
 * @property string $occupation
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time, nick, area', 'required'),
			array('uid, area, occupation', 'length', 'max'=>32),
			array('privilege, score', 'length', 'max'=>10),
			array('face_id, level', 'length', 'max'=>4),
			array('nick', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, privilege, time, score, face_id, level, nick, area, occupation', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'privilege' => 'Privilege',
			'time' => 'Time',
			'score' => 'Score',
			'face_id' => 'Face',
			'level' => 'Level',
			'nick' => 'Nick',
			'area' => 'Area',
			'occupation' => 'Occupation',
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

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('privilege',$this->privilege,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('face_id',$this->face_id,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('occupation',$this->occupation,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}