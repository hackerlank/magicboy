<?php
class DrawForm extends CFormModel {
	public $cardnum;
	
	public function rules() {
		return array(
			array(
			'cardnum', 'numerical', 'message' => '卡号必须为数字'), 
			array(
			'cardnum', 'seqCheck')
		);
	}
	
	public function seqCheck($attribute, $params) {
		$validate = new CardNum();
		
		if (!$validate->validate($this->cardnum)) {
			$message = '卡号错误';
			$this->addError($attribute, $message);
			return false;
		}
		
		return true;
	}
}