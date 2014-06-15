<?php
class WorktimeAction extends CAction {
	
	protected $_query = array(
		'name' => '', 'start' => '', 'end' => ''
	);
	
	protected $_validate = array();
	
	protected $_data = array();
	
	public function run() {
		if (!isset($_POST['worktime'])) {
			$this->display();
			return;
		}
		
		$this->_query = array_merge($this->_query, $_POST['worktime']);
		if (!$this->validate()){
			$this->display();
			return;
		}
		
		$moderator = new Moderator();
		$record = $moderator->find("name=:name", array(
			':name' => $this->_query['name'],
		));
		
		if (!$record) {
			Yii::app()->user->setFlash('error', '无此主持人');
			$this->display();
			return;
		}
		
		$param = array(':mid'=>$record->id,
					   ':start'=>$this->_validate['start'],
					   ':end'=>$this->_validate['end']);
		$command = yii::app()->db->createCommand()
			->select('*')
			->from('moderator_worktime')
			->where("mid=:mid and start>= :start and start< :end", $param);
		
		$data = $command->queryAll();
		$num = count($data);
		if (!$num){
			Yii::app()->user->setFlash('error', '暂无数据');
			$this->display();
			return;
		}
		
		$totalTime = 0;
		for ($i=0; $i<$num; $i++){
			$totalTime += $data[$i]['total'];
			$data[$i]['start'] = date("Y-m-d H:i:s", $data[$i]['start']);
		}
		

		$dataProvider = new CArrayDataProvider($data, array(
							'keyField'=>'mid',
						));
		$this->_data['dataProvider'] = $dataProvider;
		$this->_data['totalTime'] = $totalTime;
		
		$this->display();
	}
	
	protected function display() {
		$this->getController()->render('worktime', array(
			'query' => $this->_query, 'data' => $this->_data
		));
	}
	
	protected function validate(){
		if (empty($this->_query['name']) 
			|| empty($this->_query['start'])
			|| empty($this->_query['end'])){
			Yii::app()->user->setFlash('error', '参数不能为空');
			return false;
		}
		
		$this->_validate['name'] = $this->_query['name'];
		$this->_validate['start'] = strtotime($this->_query['start'] );
		$this->_validate['end'] = strtotime($this->_query['end'] );
		if (!$this->_validate['start'] | !$this->_validate['end']){
			Yii::app()->user->setFlash('error', '时间输入错误');
			return false;
		}
		
		$this->_validate['end'] += 86400;
		
		return true;
	}
}