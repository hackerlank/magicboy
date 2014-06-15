<?php
/*
author: 	1910256@qq.com

MySQL: 		mysql:host=localhost;port=3307;dbname=test
SQLServer: 	mssql:host=(local);dbname=avcache   mssql:host=127.0.0.1,1433;dbname=avcache
Access:		odbc:Driver={Microsoft Access Driver (*.mdb)};DBQ=c:\\data\\food.mdb;Uid=Chef
Oracle:		oci:food

SqLite:		sqlite:/path/to/db/file
SqLite2:	sqlite2:/path/to/db/file
SqLiteMem:	sqlite::memory:

ODBC:		odbc:DSN=food
*/

define('DIR_LOG', __DIR__.'/../log');

class PDODB
{
	private $pdo;
	
	// $info: array('dsn' => '', 'user' => '', 'password' => '', 'long' => false)
	public function connect($info){
		extract($info);
		if(isset($long) && $long){
			//$opt = array(PDO::ATTR_PERSISTENT => true);
		}
		else{
			//$opt = array(PDO::ATTR_PERSISTENT => false);
		}
		$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		if(isset($info['long']) && $info['long']){
			$opt[PDO::ATTR_PERSISTENT] = true;
		}
		try{
			$this->pdo = new PDO($dsn, $user, $password, $opt);
			$this->pdo->exec("set names 'utf8';"); 
		}
		catch(PDOException $ex){
			$this->log($ex->getMessage());
		}
	}
	
	// 事务
	public function beginTransaction(){
		$this->pdo->beginTransaction();
	}
	
	public function commit(){
		$this->pdo->commit();
	}

	public function rollBack(){
		$this->pdo->rollBack();
	}
	
	// 执行SQL
	public function exec($sql, $data=array()){
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$ret = $stmt->rowCount();
		}
		$stmt = null;
		return $ret;
	}
	
	// 返回单个内容
	public function query_one($sql, $data=array()){
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$ret = $stmt->fetchColumn();
		}
		$stmt = null;
		return $ret;
	}
	
	// 返回一行
	public function query_row($sql, $data=array()){
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$ret = $stmt->fetch();
		}
		$stmt = null;
		return $ret;
	}	

	// 返回多行
	public function query_rows($sql, $data=array()){
		$ret = array();
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$ret = $stmt->fetchAll();
		}
		$stmt = null;
		return $ret;
	}
	
	public function query_hash($sql, $keyField, $data=array()){
		$ret = array();
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$r = $this->executeStmt($stmt);
		if($r !== false){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$ret[$row[$keyField]] = $row;
			}
		}
		$stmt = null;
		return $ret;
	}

	public function query_array($sql, $data=array()){
		$ret = array();
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$r = $this->executeStmt($stmt);
		if($r !== false){
			while($row = $stmt->fetch(PDO::FETCH_NUM)){
				$ret[] = $row[0];
			}
		}
		$stmt = null;
		return $ret;
	}

	public function insert($table, $data, $cmd='insert'){
		$fieldAry = array();
		$valueAry = array();
		foreach($data as $field => $value){
			$fieldAry[] = $field;
			$valueAry[] = ":$field";
		}
		$fields = implode(',', $fieldAry);
		$values = implode(',', $valueAry);
		$sql = "$cmd into $table($fields) values($values)";

		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $data);
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$ret = $stmt->rowCount();
		}
		$stmt = null;
		return $ret;
	}
	
	public function replace($table, $data){
		return $this->insert($table, $data, 'replace');
	}
	
	public function update($table, $data, $where=array()){
		$sPair = $this->makeUpdateSQL($data);
		$sql = "update $table set $sPair";
		$sWhere = $this->makeWhereSQL($where);
		if($sWhere != ''){
			$sql .= " where $sWhere";
		}
		$fullData = array_merge(array_values($data), array_values($where));
		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, $fullData);
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$ret = $stmt->rowCount();
		}
		$stmt = null;
		return $ret;
	}
	
	public function delete($table, $where){
		$sWhere = $this->makeWhereSQL($where);
		$sql = "delete from $table";
		if($sWhere != ''){
			$sql .= " where $sWhere";
		}

		$stmt = $this->pdo->prepare($sql);
		$this->bindParams($stmt, array_values($where));
		$ret = $this->executeStmt($stmt);
		if($ret !== false){
			$ret = $stmt->rowCount();
		}
		$stmt = null;
		return $ret;
	}
	
	public function select_row($table, $where=array(), $fields='*', $orderby='', $limit=''){
		$sql = $this->makeSelectSQL($table, $where, $fields, $orderby, $limit);
		$ret = $this->query_row($sql, array_values($where));
		return $ret;
	}

	public function select_rows($table, $where=array(), $fields='*', $orderby='', $limit=''){
		$sql = $this->makeSelectSQL($table, $where, $fields, $orderby, $limit);
		$ret = $this->query_rows($sql, array_values($where));
		return $ret;
	}

	public function select_one($table, $where=array(), $fields='*', $orderby='', $limit=''){
		$sql = $this->makeSelectSQL($table, $where, $fields, $orderby, $limit);
		$ret = $this->query_one($sql, array_values($where));
		return $ret;
	}

	public function insert_id(){
		return $this->pdo->lastInsertId();
	}
	
	public function escape($s){
		return $this->pdo->quote($s);
	}
	
	//////////////////////////
	
	// 绑定参数，两种类型的参数数据：普通数组，关联数组；自动在绑定参数时添加冒号
	private function bindParams($stmt, $data){
		foreach($data as $key => $val){
			if(is_int($key)){
				$stmt->bindValue(intval($key)+1, $val);
			}
			else{
				$stmt->bindValue(':'.$key, $val);
			}
		}
	}
	
	// 执行stmt，返回影响的行数，自动记录错误日志
	private function executeStmt($stmt){
		try{
			$ret = $stmt->execute();
		}
		catch(PDOException $ex){
			$ret = false;
			$this->log($ex->getMessage() . '; ' . $stmt->queryString);
		}
		return $ret;
	}

	private function makeFieldsSQL($where, $sep){
		$whereAry = array();
		foreach($where as $field => $value){
			$whereAry[] = "$field=?";
		}
		$ret = implode($sep, $whereAry);
		return $ret;
	}
	
	private function makeWhereSQL($where){
		return $this->makeFieldsSQL($where, ' and ');
	}
	
	private function makeUpdateSQL($data){
		return $this->makeFieldsSQL($data, ',');
	}

	private function makeSelectSQL($table, $where=array(), $fields='*', $orderby='', $limit=''){
		$sWhere = $this->makeWhereSQL($where);
		$sql = "select $fields from $table";
		if($sWhere != ''){
			$sql .= " where $sWhere";
		}
		if($orderby != ''){
			$sql .= " order by $orderby";
		}
		if($limit != ''){
			$sql .= " limit $limit";
		}
		return $sql;
	}
	
	private function log($s){
		$filename = DIR_LOG . '/db.log';
		$time = date('Y-m-d H:i:s');
		@file_put_contents($filename, $time . ' ' . $s . "\r\n", FILE_APPEND);
	}
	
}
?>