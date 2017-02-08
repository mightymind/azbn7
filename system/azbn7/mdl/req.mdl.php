<?php

namespace azbn7;

class Req
{
	public $req_arr = array();
	public $data = array();
	public $event_prefix = '';//'system.azbn7.mdl.req';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function _get($k, $dflt = null) {
		if (isset($_GET[$k])) {
			return $this->Azbn7->c_s($_GET[$k]);
		} else {
			return $dflt;
		}
	}
	
	public function _post($k, $dflt = null) {
		if (isset($_POST[$k])) {
			return $this->Azbn7->c_s($_POST[$k]);
		} else {
			return $dflt;
		}
	}
	
	public function _cookie($k, $dflt = null) {
		if (isset($_COOKIE[$k])) {
			return $this->Azbn7->c_s($_COOKIE[$k]);
		} else {
			return $dflt;
		}
	}
	
	public function _server($k, $dflt = null) {
		if (isset($_SERVER[$k])) {
			return $_SERVER[$k];
		} else {
			return $dflt;
		}
	}
	
	public function parseURL()
	{
		$_ru = explode('?', $this->_server('REQUEST_URI'));
		$this->data['req_url'] = explode('/', urldecode($_ru[0]));
		$this->data['req_url'] = array_values(array_diff($this->data['req_url'], array('', null)));
		//var_dump($this->data);
		return $this;
	}
	
	public function addHeaders($headers) {
		if(count($headers)) {
			foreach($headers as $h) {
				$this->data['headers'][] = $h;
			}
		}
	}
	
	public function genHeaders($compress = false) {
		
		$this->data['headers_sended'] = true;
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.genHeaders.before',
			'title' => '',
		));
		
		if($compress) {
			@ob_start();
			@ob_start('ob_gzhandler');
		}
		//Header("Content-type: $contenttype; charset={$this->Azbn7->config['charset']}");
		
		if(isset($this->data['headers'])) {
			if(count($this->data['headers'])) {
				foreach($this->data['headers'] as $h) {
					Header($h);
				}
			}
		}
		
		Header('Expires: Sat, 19 Oct 1985 10:10:00 GMT');
		Header('Cache-Control: no-cache, must-revalidate');
		Header('Pragma: no-cache');
		Header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.genHeaders.after',
			'title' => '',
		));
		
		return $this;
	}
	
}