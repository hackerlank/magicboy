<?php
/**
 * 登录验证
 * @author ballqiu
 *
 */
class UserIdentity extends CUserIdentity {
	protected $_id;

	public function getId() {
		return $this->_id;
	}

	public function authenticate() {
		$username = $this->username;
		$user = Admin::model()->find('name=?', array($username));
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if (!$user->validatePassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else {
			$this->_id = $user->id;
			$this->username = $user->name;
			$this->errorCode = self::ERROR_NONE;
		}
		if ($this->errorCode == self::ERROR_NONE) {
			//记录最后登录的时间
			$user->time = new CDbExpression('NOW()');
			$user->ip = Yii::app()->request->userHostAddress;
			$user->save();
			//记录日志
			$log = "normal:id:{$user->id} name:{$user->name} ip:{$user->ip}";
			yii::log($log, 'info', 'login');
			return true;
		}
		else {
			$ip = Yii::app()->request->userHostAddress;
			$log = "error:name:{$username} ip:{$ip}";
			yii::log($log, 'info', 'login');
			return false;
		}
	}
}