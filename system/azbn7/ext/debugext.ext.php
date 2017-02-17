<?php

namespace azbn7\Ext;

class DebugExt
{
	public $data = null;
	public $event_prefix = '';
	
	function __construct()
	{
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
								'ext' => $this->event_prefix,
								'method' => 'storage_mysql__connect__before',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('DB')->event_prefix . '.connect.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'storage_mysql__connect__after',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Req')->event_prefix . '.parseURL.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'req__parseURL__after',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Req')->event_prefix . '.request.before'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'req__request__before',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.head.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'viewer__tpl__header_head__after',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.require.before'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'viewer__tpl__require__before',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.require.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'viewer__tpl__require__after',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.not_found'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
								'method' => 'viewer__tpl__not_found',
							),
						))
					
					->addListeners(
						array($this->Azbn7->mdl('Req')->event_prefix . '.request.after'),
						array(
							array(
								'dir' => 'azbn7',
								'ext' => $this->event_prefix,
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
		
	}
	
	public function storage_mysql__connect__after($uid, &$p = array())
	{
		
		$this->loadData();
		
		if($this->data['created_at']) {
			
		} else {
			
			$this->installExt();
			
		}
		
	}
	
	public function req__parseURL__after($uid, &$p = array())
	{
		
	}
	
	public function req__request__before($uid, &$p = array())
	{
		$this->Azbn7->mdl('Req')->addHeaders(array(
			'X-Azbn7-Ext-Debug: ' . $this->event_prefix,
		));
	}
	
	public function approuter__route__after($uid, &$p = array())
	{
		
		if($this->Azbn7->config['debug']) {
			
			$this->Azbn7->timing['stop'] = $this->Azbn7->getMicroTime();
			$this->Azbn7->timing['diff'] = $this->Azbn7->getTiming($this->Azbn7->timing['stop']);
			
			$info = array(
				'request_uri' => $this->Azbn7->mdl('Req')->_server('REQUEST_URI'),
				'_get' => $_GET,
				'_post' => $_POST,
				'timing' => $this->Azbn7->timing,
				'events' => $this->Azbn7->__events,
				'errors' => $this->Azbn7->__errors,
				'ext_events' => $this->Azbn7->mdl('Ext')->__events,
				'listeners' => $this->Azbn7->mdl('Ext')->__listeners,
			);
			
			//echo '<!-- ---------- ' . $this->Azbn7->getJSON($info) . ' ---------- -->';
			
			$fp = fopen($this->Azbn7->config['path']['cache'] . '/' . $this->event_prefix . '_' . $this->Azbn7->php_process_session . '.json', 'w');
			fwrite($fp, $this->Azbn7->getJSON($info));
			fclose($fp);
			
			//echo $this->Azbn7->config['path']['cache'] . '/' . $this->Azbn7->php_process_session . '.json';
		}
		
	}
	
	public function viewer__tpl__header_head__after($uid, &$p = array())
	{
		$uid = str_replace('.', '__', $this->event_prefix);
		$this->Azbn7->mdl('Viewer')->addBodyClass($uid);
		$this->Azbn7->mdl('Viewer')->addBodyDataAttr($uid, $this->Azbn7->getJSON($this->data));
	}
	
	public function viewer__tpl__require__before($uid, &$p = array())
	{
		if($this->Azbn7->config['debug']) {
			echo "\n" . '<!-- ---------- ' . $uid . ': ' . $p['__this_tpl']['tpl'] . ' ---------- -->' . "\n";
		}
	}
	
	public function viewer__tpl__require__after($uid, &$p = array())
	{
		if($this->Azbn7->config['debug']) {
			echo "\n" . '<!-- ---------- ' . $uid . ': ' . $p['__this_tpl']['tpl'] . ' ---------- -->' . "\n";
		}
	}
	
	public function viewer__tpl__not_found($uid, &$p = array())
	{
		if($this->Azbn7->config['debug']) {
			echo "\n" . '<!-- ---------- ' . $uid . ': ' . $p['__this_tpl']['tpl'] . ' NOT FOUND!!! ---------- -->' . "\n";
		}
	}
	
}