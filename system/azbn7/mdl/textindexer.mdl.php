<?php

namespace azbn7;

class TextIndexer
{
	public $morphy = null;
	public $event_prefix = '';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function initMorphy()
	{
		if($this->morphy) {
			
		} else {
			
			require_once($this->Azbn7->config['path']['phpmorphy'] . '/src/common.php');
			$this->morphy = new \phpMorphy($this->Azbn7->config['path']['phpmorphy'] . '/dicts/' . $this->Azbn7->config['charset'] . '/', 'ru_RU', array(
				// PHPMORPHY_STORAGE_FILE - использовать файл
				// PHPMORPHY_STORAGE_SHM - загружать словать в общую память(нужно расширение shmop)
				// PHPMORPHY_STORAGE_MEM - загружать словать в общую память при каждой инициализации phpmorphy
				'storage' => \PHPMORPHY_STORAGE_FILE,
				'predict_by_suffix' => true,
				'predict_by_db' => true,
				'graminfo_as_text' => true,
			));
			
		}
	}
	
	public function getIndex($src)
	{
		$text = $src;
		
		$text = strip_tags($text);
		
		$text = mb_strtolower(strtr($text, array(
			'.'=>' ',
			','=>' ',
			'?'=>' ',
			'!'=>' ',
			';'=>' ',
			':'=>' ',
			'"'=>' ',
			"'"=>' ',
			"\t"=>' ',
			"\r"=>' ',
			"\n"=>' ',
			'='=>' ',
			'+'=>' ',
			'-'=>' ',
			'*'=>' ',
			'|'=>' ',
			'/'=>' ',
			'\\'=>' ',
			'('=>' ',
			')'=>' ',
			'^'=>' ',
			'$'=>' ',
			'#'=>' ',
			'`'=>' ',
			'@'=>' ',
			'{'=>' ',
			'}'=>' ',
			)), $this->Azbn7->config['charset']);
		
		$text = strtr($text,array(
			'    '=>' ',
			'   '=>' ',
			'  '=>' ',
		));
		
		$text_arr = explode(' ', $text);
		
		$text_arr = array_unique($text_arr, SORT_STRING);
		
		if(count($text_arr)) {
			foreach($text_arr as $w_index=>$word) {
				
				if(mb_strlen($word, $this->Azbn7->config['charset']) > 2) {
					
				} else {
					unset($text_arr[$w_index]);
				}
				
			}
		}
		$text = mb_strtoupper(implode(' ', $text_arr), $this->Azbn7->config['charset']);
		
		/*
		тут phpmorphy
		*/
		
		$text_arr = explode(' ', $text);
		
		$text_forms = array();
		
		$this->initMorphy();
		
		foreach($this->morphy->getBaseForm($text_arr) as $w => $form_arr) {
			
			$text_forms[] = $w;
			
			if(count($form_arr)) {
				
				foreach($form_arr as $f) {
					$text_forms[] = $f;
				}
				
			} else {
				
			}
			
		}
		
		unset($text_arr);
		unset($this->morphy);
		
		$text_forms = array_unique($text_forms, SORT_STRING);
		
		$text = implode(' ', $text_forms);
		
		/*
		/тут phpmorphy
		*/
		
		$text = mb_strtolower($text, $this->Azbn7->config['charset']);
		
		return $text;
	}
}