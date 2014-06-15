<?php
class RunCommand extends CConsoleCommand {
	/**
	 * 主持人排名静态化
	 */
	public function ActionModeratorRank() {
		$rank = new ModeratorRank();
		echo date('Y-m-d H:i:s')."\t";
		if ($rank->gen()){
			echo "success\n";;
			return 0;
		}

		echo "error\n";
		return 1;
	}

	/**
	 * 用户排名静态化
	 */
	public function ActionUserRank() {
		$rank = new UserRank();
		echo date('Y-m-d H:i:s')."\t";
		if ($rank->gen()) {
			echo "success\n";;
			return 0;
		}

		echo "error\n";
		return 1;
	}

	/**
	 * 卡号生成工具
	 * @param num $type 卡类型
	 * @param num $num 数量
	 */
	public function ActionGenCard($type, $num = 10) {
		$card = new CardNum();
		if (!$card->gen($type, $num)) {
			echo $card->getError(), "\n";
			return 1;
		}

		echo "success\n";
		return 0;
	}
}