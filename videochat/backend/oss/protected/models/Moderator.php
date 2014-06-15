<?php

/**
 * This is the model class for table "moderator".
 *
 * The followings are the available columns in table 'moderator':
 * @property string $name
 * @property string $passwd
 * @property string $score
 * @property string $time
 * @property string $ip
 * @property string $id
 */
class Moderator extends CActiveRecord
{
	public $imgfile = '';
	public $url = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Moderator the static model class
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
		return 'moderator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,passwd,nick', 'required'),
			array('name, passwd, ip', 'length', 'max'=>32),
			array('score', 'length', 'max'=>10),
			array('id', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, passwd, score, time, ip, id', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'passwd' => 'Passwd',
			'score' => 'Score',
			'time' => 'Time',
			'ip' => 'Ip',
			'id' => 'ID',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('id',$this->id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * 抓取之前如果发现上传了图片，则保存图片
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave(){
		$file = CUploadedFile::getInstance($this,'imgfile');
		if(!$file){
        	return parent::beforeSave();
        }

        $url = $this->saveImgFile($file);
        if ($url === false){
        	 $this->addError('imgfile', '上传图片出错');
        	 return false;
        }

        $this->url = $url;

        return true;
	}

	/**
	 * 保存图片并返回访问使用的url
	 *
	 */
	protected function saveImgFile(CUploadedFile $file){
		$srcName = $file->name;
		list($name, $type) = explode('.', $srcName);
		$dir = yii::app()->params['uploadDir'].strtolower(__CLASS__);
		//$name = tempnam($dir, __CLASS__);
		$name = uniqid(mt_rand());
		$realName = "{$name}.{$type}";

		$fullName = $dir.DIRECTORY_SEPARATOR.$realName;
		$url = '/'.strtolower(__CLASS__)."/{$realName}";

		if (!$file->saveAs($fullName)){
			return false;
		}

		return $url;
	}

}