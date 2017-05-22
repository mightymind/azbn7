<?php

namespace app;

class Viewer
{
	public $event_prefix = '';//'app.mdl.viewer';
	
	public $body_class = 'azbn7 _preloading';
	public $evalContent__codes = array(
		'widget',
	);
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
				'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.tpl.not_found') . ': ' . $tpl,
			));
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.tpl.not_found', $param)
			;
			/* --------- /ext__event ---------- */
			
		}
		
	}
	
	public function wgt($widget_caller, $param = array())
	{
		
		$res = '';
		
		$tpl_uid = $this->Azbn7->randstr(16);
		
		if(isset($param['tpl'])) {
			
			$file = $this->Azbn7->config['path']['app'] . '/tpl/' . $this->Azbn7->config['theme'] . '/' . strtolower($param['tpl']) . '.tpl.php';
			
			if(file_exists($file)) {
				
				ob_start();
				ob_implicit_flush(0);
				
				require($file);
				
				$res = ob_get_contents();
				ob_end_clean();
				
				
				/* ---------- ext__event ---------- */
				
				$param['__this_widget_result'] = &$res;
				
				$this->Azbn7
					->mdl('Ext')
						->event($this->event_prefix . '.widget.wgt.' . $widget_caller, $param)
				;
				/* --------- /ext__event ---------- */
				
				
			} else {
				
				$res = $widget_caller;
				
			}
			
		} else if(isset($param['id'])) {
			
			$res = $widget_caller;
			
		} else {
			
			$res = $widget_caller;
			
		}
		
		return $res;
		
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
	
	public function setAzbn7BodyConfig()
	{
		
		$azbn7_config = array(
			'php_process_session' => $this->Azbn7->php_process_session,
			'path' => array(
				'root' => '',
			),
		);
		
		$this->addBodyDataAttr('azbn7', $this->Azbn7->getJSON($azbn7_config));
		
		
		
		$azbn7_config = array(
			'request_method' => 'POST',
			
		);
		
		if($this->Azbn7->mdl('Site')->is('user')) {
			
			$azbn7_config['access_as'] = 'user';
			$azbn7_config['key'] = $_SESSION['user']['key'];
			
		} else if($this->Azbn7->mdl('Site')->is('profile')) {
			
			$azbn7_config['access_as'] = 'profile';
			$azbn7_config['key'] = $_SESSION['profile']['key'];
			
		} else {
			
			$access = $this->Azbn7->mdl('DB')->one('profile', "`login` = 'anonymous'");
			$azbn7_config['access_as'] = 'profile';
			$azbn7_config['key'] = $access['key'];
			
		}
		
		$this->addBodyDataAttr('azbn7__mdl__api', $this->Azbn7->getJSON($azbn7_config));
		
	}
	
	
	public function evalContent($content = '', $p = array())
	{
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.evalContent.before', $content)
		;
		/* --------- /ext__event ---------- */
		
		
		if(count($this->evalContent__codes)) {
			foreach($this->evalContent__codes as $code) {
				$content = preg_replace_callback("/\[\[(" . $code . ")([^\]]*)\]\]/isu", array(&$this,'evalContent__callback'), $content);
			}
		}
		
		
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
		//var_dump($matches);
		$_argv = array();
		$p = array();
		
		preg_match_all(
			"/\b(\w+)=\"([^\"]*)\"/isu",
			//"/\b(\w+=([\"'])[^\\2]+?\\2)/isu",
			$matches[2],
			$_argv,
			PREG_SET_ORDER//PREG_PATTERN_ORDER
		);
		
		if(count($_argv)) {
			foreach($_argv as $_a) {
				$p[$_a[1]] = $_a[2];
			}
		}
		
		/*
		echo '<pre>';
		var_dump($matches);
		//var_dump($p);
		echo '</pre>';
		*/
		
		return $this->wgt($matches[1], $p);
	}
	
	public function echo_dev($a = array(), $for_all = false)
	{
		if($this->Azbn7->mdl('Site')->is('user') || $for_all) {
			$bt = debug_backtrace();
			$bt = $bt[0];
			$dRoot = $_SERVER['DOCUMENT_ROOT'];
			$dRoot = str_replace('/', "\\", $dRoot);
			$bt['file'] = str_replace($dRoot, '', $bt['file']);
			$dRoot = str_replace("\\", '/', $dRoot);
			$bt['file'] = str_replace($dRoot, '', $bt['file']);
			?>
			<div style="background-color:#ffffff;color:#000000;outline:1px green solid;font-size:10px;" >
				<div style="padding:5px 10px;background-color:green;color:#ffffff;font-weight:bold;" >File: <?=$bt['file'];?> [line: <?=$bt['line'];?>]</div>
				<pre style="padding:10px;" ><? print_r($a);?></pre>
			</div>
			<?
		}
	}
	
}