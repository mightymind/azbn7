<?php

namespace app;

class Viewer
{
	public $event_prefix = '';//'app.mdl.viewer';
	
	public $body_class = 'azbn7';
	public $evalContent__code = 'widget';
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
			'cache_compress' => 0,
			'cache_ttl' => 3600,
		);
		
		if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
			
			$this->Azbn7->mdl('Req')->genHeaders(true);
			
		}
		
		$file = $this->Azbn7->config['path']['app'] . '/tpl/' . $this->Azbn7->config['theme'] . '/' . strtolower($tpl) . '.tpl.php';
		
		
		$__this_tpl['file'] = $file;
		
		if(isset($param['__this_tpl'])) {
			
			$param['__this_tpl'] = array_merge($__this_tpl, $param['__this_tpl']);
			
		} else {
			
			$param['__this_tpl'] = $__this_tpl;
			
		}
		
		
		if(file_exists($file)) {
			
			
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
			
			$param['__this_tpl'] = array_merge($__this_tpl, $param['__this_tpl']);
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.tpl.not_found',
				'title' => 'Tpl ' . $tpl . ' not found!',
			));
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.not_found', $param)
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
	
	public function evalContent($content = '', $p = array())
	{
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.evalContent.before', $content)
		;
		/* --------- /ext__event ---------- */
		
		
		$content = preg_replace_callback("/\[\[" . $this->evalContent__code . "([^\]]*)\]\]/isu", array(&$this,'evalContent__callback'), $content);
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.evalContent.after', $content)
		;
		/* --------- /ext__event ---------- */
		
		return $content;
	}
	
	public function evalContent__callback($matches)
	{
		var_dump($matches);
		return 'evalContent__callback';
	}
	
	/*
	public function evalContent__callback($str)
	{
		$id = $str[1];
		
		if(isset($this->snippets[$id])) {
			$snp = $this->snippets[$id];
		} else {
			$snp=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->cfg['tbl']['item']."` WHERE (id='$id')");
		}
		
		if($snp['id']) {
			
			$_param = $this->getSnippetParams($str[2]);
			$_param['{class}'] = $snp['class'].' '.$_param['{class}'];
			$snp['html'] = strtr($this->codeByStorage('html/'.$snp['id'].'.html'),$_param);
			
			$this->snippets[$snp['id']] = $snp;
			
			return $this->parseHTML($snp['html']);
		} else {
			return '';
		}
	}
	
	public function getSnippetParams($str)
	{
		preg_match_all(
			"/(\w+)=\"([^\"]*)\"/isu",
			$str,
			$res,
			PREG_SET_ORDER//PREG_PATTERN_ORDER
			);
		$arr = array();
		if(count($res)) {
			foreach($res as $p) {
				$arr['{'.$p[1].'}']=$p[2];
			}
		}
		return $arr;
	}
	*/
	
}