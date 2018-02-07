<?php

namespace azbn7;

class Storage_MySQL
{
	public $connection = null;
	public $t = array();
	public $prefix = '';
	public $charset = '';
	public $engine = '';
	public $event_prefix = '';//'system.azbn7.mdl.storage_mysql';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function connect($db)
	{
		try {
			
			$this->t = $db['t'];
			$this->prefix = $db['prefix'];
			$this->charset = $db['charset'];
			$this->engine = $db['engine'];
			
			$this->connection = new \PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['db'], $db['user'], $db['pass'], $db['connect_settings']);
			//$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->q('SET NAMES ' . $db['charset']);
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.connect.after',
				'title' => 'azbn7.storage_mysql.connected',
			));
			
		} catch(\PDOException $e) {
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.connect.exception',
				'title' => $e->getMessage(),
			));
			
		}
		
		return $this;
	}
	
	public function disconnect()
	{
		$this->connection = null;
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.disconnect.after',
			'title' => 'azbn7.storage_mysql.disconnected',
		));
	}
	
	public function c_s($str = '')
	{
		return $this->connection->quote($str);
	}
	
	public function exec($str)
	{
		$this->connection->exec($str);
		return $this;
	}
	
	public function q($str)
	{
		return $this->connection->query($str);
	}
	
	public function last_id()
	{
		return $this->connection->lastInsertId();
	}
	
	
	
	public function create($table, $item = array(), $ignore = false)
	{
		if(count($item)) {
			
			if(isset($this->t[$table])) {
				$table = $this->t[$table];
			}
			
			$_arr_ = array();
			foreach($item as $_index => $_value){
				$_arr_[] = "`$_index` = '$_value'";
			}
			$insert_string = implode(',', $_arr_);
			
			if($ignore) {
				$ignore_str = 'IGNORE';
			} else {
				$ignore_str = '';
			}
			
			$this->q('INSERT ' . $ignore_str . ' INTO `' . $table . '` SET ' . $insert_string);
			
			return $this->last_id();
		} else {
			return null;
		}
		
	}
	
	public function read($table = '', $where = '1', $fields = '*')
	{
		if(isset($this->t[$table])) {
			$table = $this->t[$table];
		}
		
		$query = $this->q('SELECT ' . $fields . ' FROM `' . $table . '` WHERE ' . $where);
		
		//$query->setFetchMode(\PDO::FETCH_ASSOC);
		//while($row = $query->fetch()){$row};
		
		if($query) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			return array();
		}
		
	}
	
	public function join($tables = '', $where = '1', $fields = '*')
	{
		
		$query = $this->q('SELECT ' . $fields . ' FROM ' . $tables . ' WHERE ' . $where);
		
		if($query) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			return array();
		}
		
	}
	
	public function one($table = '', $where = '1')
	{
		if(isset($this->t[$table])) {
			$table = $this->t[$table];
		}
		
		$rows = $this->read($table, $where . ' LIMIT 1', $fields = '*');
		if(count($rows) == 1) {
			$item = $rows[0];
		} else {
			$item = null;
		}
		return $item;
	}
	
	public function update($table = '', $item = array(), $where = '1')
	{
		if(isset($this->t[$table])) {
			$table = $this->t[$table];
		}
		
		$_arr_ = array();
		foreach($item as $_index => $_value){
			$_arr_[] = "`$_index` = '$_value'";
		}
		$insert_string = implode(',', $_arr_);
		
		return $this->connection->exec('UPDATE `' . $table . '` SET ' . $insert_string . ' WHERE ' . $where);
	}
	
	public function delete($table = '', $where = '1')
	{
		if(isset($this->t[$table])) {
			$table = $this->t[$table];
		}
		
		return $this->connection->exec('DELETE FROM `' . $table . '` WHERE ' . $where);
	}
	
	
}