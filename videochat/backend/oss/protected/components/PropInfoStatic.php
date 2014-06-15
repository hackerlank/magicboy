<?php
class PropInfoStatic {
	protected $_db;
	//文件保存地址
	protected $_file = '';
	protected $_error = '';
	public function __construct($file = null) {
		$this->_db = new PropInfo();
		if (!$file) {
			$this->_file = dirname(dirname(__FILE__)) . '\data\PropInfo.inc';
		}
		else {
			$this->_file = $file;
		}
	}
	
	public function gen() {
		$criteria = new CDbCriteria();
		
		$res = $this->_db->findAll($criteria);
		$num = count($res);
		
		$content = '<?php return ';
		$data = array();
		for($i = 0; $i < $num; $i++) {
			$item = $res[$i]->attributes;
			if ($item['url']){
				$item['url'] = yii::app()->params['imgurl'].$item['url'];
			}
			$id = $item['id'];
			$data[$id] = $item;
		}
		
		$content = $content . var_export($data, true) . ';';
		
		$res = file_put_contents($this->_file, $content);
		if ($res > 0) {
			return true;
		}
		
		$this->_error = 'gen error';
		return false;
	}
	
	public function getFile() {
		return $this->_file;
	}
	
	public function getError() {
		return $this->_error;
	}
}