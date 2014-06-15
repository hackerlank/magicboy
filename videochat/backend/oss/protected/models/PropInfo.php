<?php

/**
 * This is the model class for table "prop_info".
 *
 * The followings are the available columns in table 'prop_info':
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string $score
 */
class PropInfo extends CActiveRecord
{
	public $imgfile = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropInfo the static model class
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
		return 'prop_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>64),
			array('url', 'length', 'max'=>128),
			array('score', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, score', 'safe', 'on'=>'search'),
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
			'url' => 'Url',
			'score' => 'Score',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('score',$this->score,true);

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

	/**
	 * 返回道具列表
	 */
	public static function getList(){
		$tb = new self();
		$data = $tb->findAll();
		$result = array();
		foreach($data as $item){
			$item = $item->getAttributes();
			$id = $item['id'];
			$result[$id] = $item;
		}

		return $result;
	}

	/**
	 * 通过道具id获得道具名
	 */
	public static function getNameFromId($id){
		static $list;
		if (empty($list)){
			$list = self::getList();
		}

		return $list[$id]['name'];
	}
}