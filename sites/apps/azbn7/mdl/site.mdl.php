<?php

namespace app;

class Site
{
	public $event_prefix = '';//'app.mdl.site';
	public $cache = array();
	public $is_mainpage = false;
	public $__lang_data = array();
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function is($type = 'user')
	{
		return $this->Azbn7->as_num(isset($_SESSION[$type]['id']) ? $_SESSION[$type]['id'] : 0);
	}
	
	public function log($uid = 'default', $p = array())
	{
		$entity = isset($p['entity']) ? $p['entity'] : 0;
		
		$item = array(
			'created_at' => $this->Azbn7->created_at,
			'user' => $this->is('user'),
			'profile' => $this->is('profile'),
			'entity' => $entity,
			'uid' => $uid,
			'param' => $this->Azbn7->getJSON($p),
		);
		
		return $this->Azbn7->mdl('DB')->create('log', $item);
	}
	
	public function url($url = '')
	{
		return $this->Azbn7->config['path']['root'] . $url;
	}
	
	public function sysopt_set($uid, $value = '')
	{
		$res = 0;
		
		$opt = $this->Azbn7->mdl('DB')->one('sysopt', "uid = '$uid'");
		
		if(($value != '' && is_object($value)) || ($opt['json'])) {
			
			$json = 1;
			
			$value = $this->Azbn7->getJSON($value);
			
		} else {
			
			$json = 0;
			
		}
		
		if($opt['id']) {
			
			$this->Azbn7->mdl('DB')->update('sysopt', array('value' => $value), "id = '{$opt['id']}'");
			
			$res = $opt['id'];
			
		} else {
			
			$res = $this->Azbn7->mdl('DB')->create('sysopt', array(
				'json' => $json,
				'editable' => 1,
				'uid' => $uid,
				'value' => $value,
			));
			
		}
		
		return $res;
	}
	
	public function sysopt_get($uid, $default = null)
	{
		$opt = $this->Azbn7->mdl('DB')->one('sysopt', "uid = '$uid'");
		
		if($opt['id']) {
			
			if($opt['json']) {
				$opt['value'] = $this->Azbn7->parseJSON($opt['value']);
			}
			
			return $opt['value'];
			
		} else {
			
			return $default;
			
		}
		
	}
	
	public function selectTheme($theme = '')
	{
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.selectTheme.before', $theme)
		;
		/* --------- /ext__event ---------- */
		
		
		if(isset($theme) && $theme != '') {
			
			$this->Azbn7->config['theme'] = $theme;
			
		} elseif($this->Azbn7->mdl('Viewer')->is_admin_tpl) {
			
			$this->Azbn7->config['theme'] = $_SESSION['user']['param']['theme_admin'];
			
		} elseif($this->Azbn7->mdl('Site')->is('user')) {
			
			if(isset($_SESSION['user']['param']['theme'])) {
				$this->Azbn7->config['theme'] = $_SESSION['user']['param']['theme'];
			}
			
		} elseif($this->Azbn7->mdl('Site')->is('profile')) {
			
			if(isset($_SESSION['profile']['param']['theme'])) {
				$this->Azbn7->config['theme'] = $_SESSION['profile']['param']['theme'];
			}
			
		} elseif(isset($_COOKIE['theme'])) {
			
			$this->Azbn7->config['theme'] = $this->Azbn7->mdl('Req')->_cookie('theme');
			
		} else {
			
			
			
		}
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.selectTheme.after', $theme)
		;
		/* --------- /ext__event ---------- */
		
		
	}
	
	public function selectLang($lang = '')
	{
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.selectLang.before', $lang)
		;
		/* --------- /ext__event ---------- */
		
		
		if(isset($lang) && $lang != '') {
			
			$this->Azbn7->config['lang'] = $lang;
			
		} elseif(isset($_COOKIE['lang'])) {
			
			$this->Azbn7->config['lang'] = $this->Azbn7->mdl('Req')->_cookie('lang');
			
		} elseif(isset($_GET['lang'])) {
			
			$this->Azbn7->config['lang'] = $this->Azbn7->mdl('Req')->_get('lang');
			
		} elseif(isset($_POST['lang'])) {
			
			$this->Azbn7->config['lang'] = $this->Azbn7->mdl('Req')->_post('lang');
			
		} else {
			
			
			
		}
		
		//$this->loadLang($this->Azbn7->config['lang']);
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.selectLang.after', $lang)
		;
		/* --------- /ext__event ---------- */
		
		
	}
	
	public function loadLang()//$lang = 'ru_ru'
	{
		
		$file = $this->Azbn7->config['path']['app'] . '/lang/' . strtolower($this->Azbn7->config['lang']) . '.lang.json';
		
		if(file_exists($file)) {
			
			//require($file);
			$tmp_lang_data = $this->Azbn7->parseJSON(file_get_contents($file));
			
			$this->Azbn7->mdl('Lang')->loadData($tmp_lang_data);
			
		}
		
	}
	
	public function msg($uid = '')
	{
		
		if(isset($this->__lang_data[$uid])) {
			echo $this->__lang_data[$uid];
		} else {
			echo $uid;
		}
		
	}
	
	public function render($tpl = 'default', $p)
	{
		/*
		if($this->Azbn7->mdl('Viewer')->is_admin_tpl) {
			$admin_str = '/admin';
		} else {
			$admin_str = '';
		}
		*/
		
		$this->Azbn7->mdl('Viewer')
			->tpl('_' . '/header', $p);
		
		$this->Azbn7->mdl('Viewer')
			->tpl($tpl, $p);
		
		$this->Azbn7->mdl('Viewer')
			->tpl('_' . '/footer', $p);
	}
	
	public function showSEOHeader(&$entity)
	{
		
		$seo = $this->Azbn7->mdl('DB')->one('entity_seo', "entity = '{$entity['entity']['id']}'");
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.showSEOHeader.before', $seo)
		;
		/* --------- /ext__event ---------- */
		
		
		if($seo['id']) {
			
			echo "<title>{$seo['title']}</title>\n";
			echo "<meta name=\"description\" content=\"{$seo['description']}\" />\n";
			echo "<meta name=\"keywords\" content=\"{$seo['keywords']}\" />\n";
			
		} else {
			
			echo "<title>{$entity['item']['title']}</title>\n";
			echo "<meta name=\"description\" content=\"{$entity['item']['preview']}\" />\n";
			
		}
		
	}
	
	public function buildHierarchy(&$arr = array())
	{
		$res_arr = array(
			'items' => array(),
			'tree' => array(),
		);
		
		if(count($arr)) {
			foreach($arr as $k => $v) {
				$res_arr['items'][$v['id']] = $v;
				$res_arr['tree'][$v['parent']][$v['id']] = &$res_arr['items'][$v['id']];
			}
		}
		
		return $res_arr;
	}
	
}
