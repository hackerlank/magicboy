<?php

/**
 * This is the model class for table "card_info".
 *
 * The followings are the available columns in table 'card_info':
 * @property string $id
 * @property string $name
 * @property string $prop_list
 * @property string $desc
 */
class CardInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CardInfo the static model class
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
		return 'card_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>32),
			array('prop_list, desc', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, prop_list, desc', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'prop_list' => 'Prop List',
			'desc' => 'Desc',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('prop_list',$this->prop_list,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function propList2array($propInfo){
		if (empty($this->prop_list)){
			return array();
		}

		$tmp = explode(";", $this->prop_list);
		if (empty($tmp)){
			return array();
		}

		$result = array();
		foreach ($tmp as $item){
			if (empty($item)){
				continue;
			}
			list($id, $num) = explode("-", $item);
			if (empty($id) || empty($num)){
				continue;
			}
			$result[] = array('id'=>$propInfo[$id]['id'], 'name'=>$propInfo[$id]['name'], 'num'=>$num);
		}

		return $result;
	}
}