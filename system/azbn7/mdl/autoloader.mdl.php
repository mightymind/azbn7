<?php

namespace azbn7;

class Autoloader
{
	public $event_prefix = '';//'system.azbn7.mdl.autoloader';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function loader($class)
	{
		
		$file = $this->Azbn7->config['path']['vendor'] . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
		
		if (file_exists($file)) {
			require($file);
			return true;
		}
		
		return false;
		
	}
	
	public function register_autoloaders()
	{
		
		spl_autoload_register(array(&$this, 'loader'));
		
		return $this->Azbn7;
		
	}
	
}