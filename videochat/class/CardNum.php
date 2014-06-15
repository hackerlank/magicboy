<?php
/**
 * 从后台oss/protected/compoents拷贝过来的
 * 两个要一起改
 * 卡号的生成和校验
 * 具体规则详见文档"卡号生成及校验"
 * @author ballqiu
 *
 */
class CardNum {
	CONST TYPE_LEN = 1;
	CONST SEQ_LEN = 12;
	CONST SUM_LEN = 2;
	CONST PARITY_LEN = 1;
	CONST TOTAL_LEN = 16;
	CONST MODEL_NAME_PREFIX = 'Card';
	CONST MAX_CARD_NUM = 3;//目前最大卡号 验证时用

	protected $_error;
	/**
	 * 产生卡号
	 * @param num $type 卡类型 1-9
	 * @param num $total 数量
	 */
	public function gen($type = 0, $total = 0) {
		$type = intval($type);
		$total = intval($total);

		if ($this->validateType($type) == false){
			$this->_error = 'type error';
			return false;
		}

		$realTotal = 0;
		while ($realTotal < $total) {
			$model = $this->getModel($type);
			$model->seq = $this->genOne($type);
			try {
				$res = $model->insert();
			} catch ( Exception $e ) {
				echo $e->getMessage();
				continue;
			}

			if ($res === true) {
				$realTotal++;
			}

			unset($model);
		}

		return true;
	}

	public function getError(){
		return $this->_error;
	}

	/**
	 *
	 * 产生一个卡号
	 * @param num $type:1~9
	 * return str
	 */
	protected function genOne($type = 0) {
		if ($type === 0) {
			return false;
		}

		$seq = $this->getSeq();
		$sum = $this->getSum($seq);
		$parity = $this->getParity($sum);

		$cardNum = sprintf("%s%s%s%s", $type, $seq, $sum, $parity);

		return $cardNum;
	}

	/**
	 *
	 * 验证卡号的正确性
	 * @param str $cardNum
	 * return true/false
	 */
	public function validate($cardNum) {
		$cardNum = strval($cardNum);
		if (strlen($cardNum) < self::TOTAL_LEN) {
			return false;
		}
		if (!is_numeric($cardNum)) {
			return false;
		}

		$pos = 0;
		$type = substr($cardNum, $pos, self::TYPE_LEN);
		$pos += self::TYPE_LEN;

		$seq = substr($cardNum, $pos, self::SEQ_LEN);
		$pos += self::SEQ_LEN;

		$sum = substr($cardNum, $pos, self::SUM_LEN);
		$pos += self::SUM_LEN;

		$parity = substr($cardNum, $pos, self::PARITY_LEN);

		//验证sum
		$expectSum = $this->getSum($seq);
		if ($sum !== $expectSum) {
			return false;
		}

		if (!$this->validateParity($parity, $sum)) {
			return false;
		}

		return true;
	}

	protected function validateType($type){
		if ($type > self::MAX_CARD_NUM || $type <= 0){
			return false;
		}

		return true;
	}

	protected function getModel($type) {
		$name = self::MODEL_NAME_PREFIX . $type;
		if (!class_exists($name)) {
			echo "model class $name not exist";
			exit();
		}

		return new $name();
	}

	/**
	 * 产生12位随机数字串
	 * return 数字字串
	 */
	protected function getSeq() {
		$num = sprintf("%04d%08d", mt_rand(1, 9999), mt_rand(1, 9999999));
		return $num;
	}

	/**
	 *
	 * 获取SUM位
	 * @param str $strNum
	 */
	protected function getSum($strNum) {
		$len = strlen($strNum);
		if ($len != self::SEQ_LEN) {
			return false;
		}

		$sum = 0;
		for($i = 0; $i < self::SEQ_LEN; $i++) {
			$sum += intval($strNum[$i]);
		}

		$start = self::SUM_LEN * (-1);
		$len = self::SUM_LEN;
		$lastStr = substr(strval($sum), $start, $len);
		//避免只有一位的情况
		$lastStr = str_pad($lastStr, self::SUM_LEN, '0', STR_PAD_LEFT);

		return $lastStr;
	}

	/**
	 * 获取Parity位
	 * @param str $sum
	 */
	protected function getParity($sum) {
		$sum = intval($sum);
		if ($this->isEven($sum)) {
			return $this->getEven();
		}

		return $this->getEven() + 1;
	}

	/**
	 * 验证Parity
	 * @param str $sum
	 * @param str $parity
	 * return true/false
	 */
	protected function validateParity($parity, $sum) {
		$parity = intval($parity);
		$sum = intval($sum);

		if ($this->isEven($sum)) {
			return $this->isEven($parity);
		}

		return !$this->isEven($parity);
	}

	/**
	 * 获取随机偶数
	 */
	protected function getEven() {
		$strNumList = array(0, 2, 4, 6, 8);
		$pos = mt_rand(0, 4);
		return $strNumList[$pos];
	}

	protected function isEven($num) {
		return ($num % 2) == 0;
	}
}