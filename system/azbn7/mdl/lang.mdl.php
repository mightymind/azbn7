<?php

namespace azbn7;

class Lang
{
	public $data = array(
		'error.default' => 'Default error',
	);
	public $event_prefix = '';//'system.azbn7.mdl.req';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function loadData($tmp_lang_data = array())
	{
		
		$this->data = array_merge($this->data, $tmp_lang_data);
		
	}
	
	public function msg($uid = '')
	{
		
		if(isset($this->data[$uid])) {
			return $this->data[$uid];
		} else {
			return $uid;
		}
		
	}
	
}