<?php

namespace app;

class Viewer
{
	public $event_prefix = '';//'app.mdl.viewer';
	
	public $body_class = 'azbn7';
	public $body_data_attr = ' ';
	public $is_admin_tpl = false;
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function tpl($tpl, $param = array())
	{
		
		$tpl_uid = $this->Azbn7->randstr(16);
		
		if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
			
			$this->Azbn7->mdl('Req')->genHeaders(true);
			
		}
		
		$file = $this->Azbn7->config['path']['app'] . '/tpl/' . $this->Azbn7->config['theme'] . '/' . strtolower($tpl) . '.tpl.php';
		
		if(file_exists($file)) {
			
			/*
			if($this->Azbn7->config['debug']) {
				echo "\n" . '<!-- ---------- ' . $this->event_prefix . ': tpl before: ' . $tpl . ' ---------- -->' . "\n";
			}
			*/
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.require.before', $tpl)
			;
			/* --------- /ext__event ---------- */
			
			
			require($file);
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.require.after', $tpl)
			;
			/* --------- /ext__event ---------- */
			
			
			/*
			if($this->Azbn7->config['debug']) {
				echo "\n" . '<!-- ---------- ' . $this->event_prefix . ': tpl after: ' . $tpl . ' ---------- -->' . "\n";
			}
			*/
			
		} else {
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.tpl.not_found',
				'title' => 'Tpl ' . $tpl . ' not found!',
			));
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.not_found', $tpl)
			;
			/* --------- /ext__event ---------- */
			
		}
		
	}
	
	public function addBodyClass($class = '')
	{
		$this->body_class = $this->body_class . ' ' . $class;
	}
	
	public function addBodyDataAttr($k, $v)
	{
		$this->body_data_attr = $this->body_data_attr . ' data-' . $k . "='" . $v . "'";
	}
	
	public function bodyClass($class = '')
	{
		return $this->body_class . ' ' . $class;
	}
	
	public function bodyDataAttrs($data = '')
	{
		return $this->body_data_attr . ' ' . $data;
	}
	
}