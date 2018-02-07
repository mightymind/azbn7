<?php

namespace azbn7;

class FS
{
	public $req_arr = array();
	public $data = array();
	public $event_prefix = '';//'system.azbn7.mdl.fs';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public  function getFilesInDir($dir = '.')
	{
		$files = array();
		$dirs = array();
		
		//$dir = iconv('UTF-8', 'Windows-1251', $dir);
		
		/*
		if (preg_match('#[\x{0600}-\x{06FF}]#iu', $dir)) {
			// convert input ( utf-8 ) to output ( windows-1256 )
			$dir = iconv('utf-8', 'windows-1251',$dir);
		}
		*/
		
		$fp = opendir($dir);
		
		while($_item = readdir($fp)) {
			
			//$__item = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? mb_convert_encoding($_item, 'utf8', 'cp1251') : $_item;
			
			if(is_file($dir . '/' . $_item)) {
				
				$files[] = array(
					'dir' => $dir,
					'item' => $_item,
					'type' => 'f',
				);
				
			} else if($_item != '.' && $_item != '..' && is_dir($dir . '/' . $_item)) {
				
				$dirs[] = array(
					'dir' => $dir,
					'item' => $_item,
					'type' => 'd',
					'children' => array(),
				);
				
			}
			
		}
		
		closedir($fp);
		
		$items = array_merge($dirs, $files);
		
		return $items;
	}
	
	public function buildTree($dir = '.')
	{
		$root_arr = $this->getFilesInDir($dir);
		if(count($root_arr)) {
			foreach($root_arr as $item_index => $item) {
				if(is_array($root_arr[$item_index]['children'])) {
					$root_arr[$item_index]['children'] = $this->buildTree($dir . '/' . $root_arr[$item_index]['item']);
				}
			}
		}
		return $root_arr;
	}
	
	/*
	public function copyFile($from = '', $to = '')
	{
		
	}
	*/
	
}