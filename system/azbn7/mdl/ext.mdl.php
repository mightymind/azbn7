<?php

namespace azbn7;

class Ext
{
	public $data = array();
	public $__listeners = array();
	public $__exts = array();
	public $__events = array();
	public $event_prefix = '';//'system.azbn7.ext';
	public $ext__ns_delimiter = '::';
	//public $ext_session = '';
	
	function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function load($arr)
	{
		/*
		array(
			'dir' => 'папка',
			'ext' => 'имя класса',
			//'uid' => 'уникальный ID',
			'param' => array()
		)
		*/
		
		$class_name = $arr['dir'] . '\\' . 'Ext' . '\\' . str_replace('/', '\\', $arr['ext']);//'\\' . 
		
		//die($class_name);
		
		//$arr['uid'] = $arr['dir'] . $this->ext__ns_delimiter  . $arr['ext'];
		
		$arr['uid'] = strtolower(str_replace('\\', '.', $class_name));
		
		if(isset($this->__exts[$arr['uid']])) {
			unset($this->__exts[$arr['uid']]);
		}
		
		$file = $this->Azbn7->config['path'][$arr['dir']] . '/ext/' . strtolower($arr['ext']) . '.ext.php';
		
		if(file_exists($file)) {
			require($file);
			
			$this->__exts[$arr['uid']] = new $class_name($arr['param']);//$arr['ext']
			
			$this->__exts[$arr['uid']]->Azbn7 = &$this->Azbn7;
			
			if(method_exists($this->__exts[$arr['uid']], 'connectToListeners')) {
				$this->__exts[$arr['uid']]->connectToListeners();
			}
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.load.after',
				'title' => $arr['ext'] . ' was loaded as '. $arr['uid'],
			));
		}
		
		return $this;
	}
	
	public function ext($uid)
	{
		if($this->__exts[$uid]) {
			return $this->__exts[$uid];
		} else {
			return $this;
		}
	}
	
	public function addListeners($events, $listeners)
	{
		if(count($events)) {
			foreach($events as $e) {
				
				if(count($listeners)) {
					foreach($listeners as $l) {
						$this->__listeners[$e][] = $l;
					}
				}
				
			}
		}
		
		return $this;
	}
	
	public function event($uid = '', &$p = array())
	{
		$this->__events[] = $uid;
		if(isset($this->__listeners[$uid])) {
			if(count($this->__listeners[$uid])) {
				foreach($this->__listeners[$uid] as $e) {
					
					$ns = $e['dir'];
					$ext = $e['ext'];
					$f = $e['method'];
					
					if($this->__exts[$ext]) {
						if(method_exists($this->__exts[$ext], $f)) {
							$this->ext($ext)->$f($uid, $p);
						}
					}
					
					
				}
			}
		}
	}
	
	public function loadExts($arr = array())
	{
		
		if(count($arr)) {
			foreach($arr as $e) {
				$this->Azbn7
					->mdl('Ext')
						->load($e)
				;
			}
		}
		
	}
	
}