<?php

namespace app;

class Viewer
{
	public $event_prefix = '';//'app.mdl.viewer';
	
	public $body_class = 'azbn7';
	public $body_data_attr = ' ';
	public $is_admin_tpl = false;
	public $inCache = false;
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function tpl($tpl, $param = array())
	{
		
		$tpl_uid = $this->Azbn7->randstr(16);
		
		$__this_tpl = array(
			'tpl' => $tpl,
			'uid' => $tpl_uid,
			'cache' => 0,
			'cache_ttl' => 3600,
		);
		
		if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
			
			$this->Azbn7->mdl('Req')->genHeaders(true);
			
		}
		
		$file = $this->Azbn7->config['path']['app'] . '/tpl/' . $this->Azbn7->config['theme'] . '/' . strtolower($tpl) . '.tpl.php';
		
		if(file_exists($file)) {
			
			$__this_tpl['file'] = $file;
			
			if(isset($param['__this_tpl'])) {
				
				$param['__this_tpl'] = array_merge($__this_tpl, $param['__this_tpl']);
				
			} else {
				
				$param['__this_tpl'] = $__this_tpl;
				
			}
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.require.before', $param)
			;
			/* --------- /ext__event ---------- */
			
			
			if(!$this->inCache) {
				require($file);
			}
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.require.after', $param)
			;
			/* --------- /ext__event ---------- */
			
			
		} else {
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.tpl.not_found',
				'title' => 'Tpl ' . $tpl . ' not found!',
			));
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.not_found', $__this_tpl)
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