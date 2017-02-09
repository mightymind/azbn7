<?php

namespace app\Ext\Azbn_ru\SimpleCache;

class SimpleCache
{
	public $data = null;
	public $event_prefix = '';
	public $isCaching = false;
	public $cacheOf = null;
	
	function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
		$this->data = array();
	}
	
	public function connectToListeners()
	{
		
		$this->Azbn7
			->mdl('Ext')
				
				->addListeners(
					array($this->Azbn7->mdl('DB')->event_prefix . '.connect.after'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'storage_mysql__connect__after',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.require.before'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'viewer__tpl__require__before',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.require.after'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'viewer__tpl__require__after',
						),
					))
		
		;
		
	}
	
	public function installExt()
	{
		
		$this->data['created_at'] = $this->Azbn7->created_at;
		
		//$this->data['cached_at'] = $this->Azbn7->created_at;
		
		//$this->data['cache_ttl'] = 30;
		
		$this->saveData();
		
	}
	
	public function loadData()
	{
		
		$__data = $this->Azbn7->mdl('Site')->sysopt_get($this->event_prefix);
		
		if($__data) {
			
			$this->data = $__data;
			
		} else {
			
			$this->saveData();
			
		}
		
	}
	
	public function saveData()
	{
		
		$this->Azbn7->mdl('Site')->sysopt_set($this->event_prefix, (object) $this->data);
		
	}
	
	public function html_compress($html = '')
	{
		preg_match_all('!(<(?:code|pre|script).*>[^<]+</(?:code|pre|script)>)!', $html, $pre);
		
		$html = preg_replace('!<(?:code|pre).*>[^<]+</(?:code|pre)>!', '#pre#', $html);
		$html = preg_replace('#<!–[^\[].+–>#', '', $html);
		$html = preg_replace('/[\r\n\t]+/', ' ', $html);
		$html = preg_replace('/>[\s]+</', '><', $html);
		$html = preg_replace('/[\s]+/', ' ', $html);
		
		if (!empty($pre[0])) {
			foreach ($pre[0] as $tag) {
				$html = preg_replace('!#pre#!', $tag, $html,1);
			}
		}
		
		return $html;
	}
	
	public function caching_start()
	{
		
		$this->isCaching = true;
		
		ob_start();
		ob_implicit_flush(0);
		
	}
	
	public function caching_stop()
	{
		
		ob_end_clean();
		
		$this->isCaching = false;
		
	}
	
	public function caching_content()
	{
		
		return ob_get_contents();
		
	}
	
	public function caching_storage_file(&$tpl = array())
	{
		
		return $this->Azbn7->config['path']['cache'] . '/' . $this->event_prefix . '_' . $this->Azbn7->hash($tpl['file'], $this->event_prefix, $this->data['created_at']) . '.html';
		
	}
	
	public function caching_save(&$tpl = array())
	{
		//ob_get_length();
		$content = $this->caching_content();
		
		if($tpl['cache_compress']) {
			$content = $this->html_compress($content);
		}
		
		$file = $this->caching_storage_file($tpl);
		
		$fp = fopen($file, 'w');
		fwrite($fp, $content);
		fclose($fp);
		
		return $content;
		
	}
	
	public function caching_show(&$tpl = array())
	{
		
		@readfile($this->caching_storage_file($tpl));
		//echo $this->caching_storage_file($tpl);
		
	}
	
	public function storage_mysql__connect__after($uid, &$p = array())
	{
		
		$this->loadData();
		
		if($this->data['created_at']) {
			
		} else {
			
			$this->installExt();
			
		}
		
	}
	
	public function viewer__tpl__require__before($uid, &$p = array())
	{
		//$p['__this_tpl']['tpl']
		
		if($this->isCaching) {
			
			$this->Azbn7->mdl('Viewer')->inCache = false;
			
		} else {
			
			if($p['__this_tpl']['cache']) {
				
				$this->Azbn7->mdl('Viewer')->inCache = true;
				
				$this->cacheOf = $p['__this_tpl']['uid'];
				
				//$__moment = $this->Azbn7->created_at - $this->data['cache_ttl'];//$p['__this_tpl']['cache_ttl'];
				
				if(!file_exists($this->caching_storage_file($p['__this_tpl'])) || (filemtime($this->caching_storage_file($p['__this_tpl'])) < ($this->Azbn7->created_at - $p['__this_tpl']['cache_ttl']))) {
					
					$this->Azbn7->mdl('Viewer')->inCache = false;
					
					$this->caching_start();
					
				}
				
			} else {
				
				$this->Azbn7->mdl('Viewer')->inCache = false;
				
			}
			
		}
		
	}
	
	public function viewer__tpl__require__after($uid, &$p = array())
	{
		//$p['__this_tpl']['tpl']
		
		if($this->cacheOf == $p['__this_tpl']['uid']) {
			
			if($p['__this_tpl']['cache']) {
				
				if($this->isCaching) {
					
					$content = $this->caching_save($p['__this_tpl']);
					$this->caching_stop();
					
					echo $content;
					
					//$this->data['cached_at'] = $this->Azbn7->created_at;
					//$this->saveData();
					
				} else {
					
					$this->caching_show($p['__this_tpl']);
					
				}
				
				$this->Azbn7->mdl('Viewer')->inCache = false;
				
			}
			
		}
		
		
		
	}
	
}