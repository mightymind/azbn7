<?php

//namespace azbn7;

class Ext
{
	public $data = array();
	public $__listeners = array();
	public $__exts = array();
	public $event_prefix = 'system.azbn7.ext';
	public $ext__ns_delimiter = '::';
	
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
		
		$arr['uid'] = $arr['dir'] . $this->ext__ns_delimiter  . $arr['ext'];
		
		if(isset($this->__exts[$arr['uid']])) {
			unset($this->__exts[$arr['uid']]);
		}
		
		$file = $this->Azbn7->config['path'][$arr['dir']] . '/ext/' . strtolower($arr['ext']) . '.ext.php';
		
		if(file_exists($file)) {
			require($file);
			
			$this->__exts[$arr['uid']] = new $arr['ext']($arr['param']);
			
			$this->__exts[$arr['uid']]->Azbn7 = &$this->Azbn7;
			
			$this->event(array(
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
	}
	
	public function event($uid)
	{
		
		if($this->__listeners[$uid]) {
			if(count($this->__listeners[$uid])) {
				foreach($this->__listeners[$uid] as $e) {
					$ns = $e['dir'];
					$ext = $e['ext'];
					$f = $e['method'];
					$o = &$this->ext($ns . $this->ext__ns_delimiter . $ext);
					$o->$f($uid);
				}
			}
		}
		
	}
	
}