<?php

/**
 * This is the model class for table "black".
 *
 * The followings are the available columns in table 'black':
 * @property string $uid
 * @property integer $speak
 * @property integer $login
 */
class Black extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Black the static model class
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
		return 'black';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, speak, login', 'required'),
			array('uid', 'uidValidate', 'on'=>'create'),
			array('speak, login', 'numerical', 'integerOnly'=>true),
			array('uid', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, speak, login', 'safe', 'on'=>'search'),
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
			'speak' => 'Speak',
			'login' => 'Login',
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
		$criteria->compare('speak',$this->speak);
		$criteria->compare('login',$this->login);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 1.确保创建的uid不在black表中存在
	 * 2.确保user表中有该用户uid
	 */
	public function uidValidate(){
		if ($this->hasErrors()){
			return;
		}
		if ($this->findByPk($this->uid)){
			$this->addError('uid', '该用户id(uid)已在黑名单中存在');
		}
		
		$tb = new User();
		if (!$tb->findByPk($this->uid)){
			$this->addError('uid', '该用户id(uid)在用户表中不存在');
		}
	}
}