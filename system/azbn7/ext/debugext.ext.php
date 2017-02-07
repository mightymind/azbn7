<?php

namespace azbn7\Ext;

class DebugExt
{
	public $data = null;
	public $event_prefix = '';//__NAMESPACE__ . '\DefaultExt';
	
	function __construct()
	{
		//echo $this->event_prefix;
		//$this->event_prefix = strtolower(str_replace('\\', '.', $this->event_prefix));
		
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
		$this->data = array();
	}
	
	public function connectToListeners()
	{
		
		if($this->Azbn7->config['debug']) {
			
			$this->Azbn7
				->mdl('Ext')
					
					->addListeners(
						array($this->Azbn7->mdl('DB')->event_prefix . '.connect.before'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => 'DebugExt',
								'method' => 'storage_mysql__connect__before',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('DB')->event_prefix . '.connect.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => 'DebugExt',
								'method' => 'storage_mysql__connect__after',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Req')->event_prefix . '.parseURL.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => 'DebugExt',
								'method' => 'req__parseURL__after',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Req')->event_prefix . '.request.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => 'DebugExt',
								'method' => 'approuter__route__after',
							),
						))
					
			
			;
			
		}
		
	}
	
	public function installExt()
	{
		
		$this->data['created_at'] = $this->Azbn7->created_at;
		
		
		
		$this->saveData();
		
	}
	
	public function loadData()
	{
		
		$__data = $this->Azbn7->mdl('Site')->sysopt_get($this->event_prefix);
		
		if($__data) {
			
			$this->data = $__data;
			
		} else {
			
			$this->saveData();
			
		}
		
	}
	
	public function saveData()
	{
		
		$this->Azbn7->mdl('Site')->sysopt_set($this->event_prefix, (object) $this->data);
		
	}
	
	public function storage_mysql__connect__before($uid, &$p = array())
	{
		//$this->Azbn7->echo_dev('Этот код выполняется перед подключением к БД', $this->event_prefix);
	}
	
	public function storage_mysql__connect__after($uid, &$p = array())
	{
		//$this->Azbn7->echo_dev('Этот код выполняется после подключения к БД<br />', $this->event_prefix);
		
		$this->loadData();
		
		if($this->data['created_at']) {
			
		} else {
			
			$this->installExt();
			
		}
		
	}
	
	public function req__parseURL__after($uid, &$p = array())
	{
		//$this->Azbn7->echo_dev('Этот код выполняется после парсинга запроса', $this->event_prefix);
	}
	
	public function approuter__route__after($uid, &$p = array())
	{
		//$this->Azbn7->echo_dev('Этот код выполняется после обработки запроса', $this->event_prefix);
		if($this->Azbn7->config['debug']) {
			
			$this->Azbn7->timing['stop'] = $this->Azbn7->getMicroTime();
			$this->Azbn7->timing['diff'] = $this->Azbn7->timing['stop'] - $this->Azbn7->timing['start'];
			
			$info = array(
				'request_uri' => $this->Azbn7->mdl('Req')->_server('REQUEST_URI'),
				'_get' => $_GET,
				'_post' => $_POST,
				'timing' => $this->Azbn7->timing,
				'events' => $this->Azbn7->__events,
				'errors' => $this->Azbn7->__errors,
				'listeners' => $this->Azbn7->mdl('Ext')->__listeners,
			);
			
			//echo '<!-- ---------- ' . $this->Azbn7->getJSON($info) . ' ---------- -->';
			
			$fp = fopen($this->Azbn7->config['path']['cache'] . '/' . $this->Azbn7->php_process_session . '.json', 'w');
			fwrite($fp, $this->Azbn7->getJSON($info));
			fclose($fp);
			
			//echo $this->Azbn7->config['path']['cache'] . '/' . $this->Azbn7->php_process_session . '.json';
		}
	}
	
}