<?php

namespace app;

class AppRouter
{
	public $event_prefix = '';//'app.mdl.approuter';
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function route($req = array())
	{
		
		$_req = $req;
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.route.before',
			'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.route.before'),
		));
		
		$this->Azbn7->mdl('Site')->selectLang();
		
		$this->Azbn7->mdl('Site')->loadLang();
		
		if(count($req)) {
			
			//var_dump($this->Azbn7->data['mdl']['Req']['req_url']);
			
			$this->loadURLAlias();
			
			$this->checkURLAlias($req);
			
			$this->checkIsUser($req);
			
			$this->Azbn7->mdl('Site')->selectTheme();
			
			/*
			if(count($_POST)) {
				
			}
			*/
			//var_dump($req);
			
			if($this->checkRouteJSONExists($req)) {
				
				// найден файл с параметрами url
				
			} elseif($this->checkFileExists($req)) {
				
				// найден файл-обработчик
				
			} elseif($this->checkRouteExists($req)) {
				
				// найден адрес для роутера
				
			} elseif($this->checkEntityExists($req)) {
				
				// найдена запись в БД
				
			} /*elseif($this->checkCatExists($req)) {
				
				// найдена категория в БД
				
			}*/ else {
				
				// страница ошибки
				
				$this->page404($req);
				
			}
			
		} else {
			
			// главная страница
			
			$this->Azbn7->mdl('Site')->is_mainpage = true;
			
			if($this->checkRouteJSONExists(array())) {
				
				
				
			} else {
				
				$this->Azbn7->run('app', 'route/index', $_req);
				
			}
			
		}
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.route.after',
			'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.route.after'),
		));
		
	}
	
	public function page404($req)
	{
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.page404',
			'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.page404'),
		));
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.page404', $req)
		;
		/* --------- /ext__event ---------- */
		
		
		$this->Azbn7->run('app', 'route/error/404', $req);
		
	}
	
	public function checkRouteJSONExists($req)
	{
		
		$res_file = $this->Azbn7->config['path']['app'] . '/route/' . implode('/', $req) . '/route.json';
		
		//echo $res_file;
		
		$res = file_exists($res_file);
		
		if($res) {
			
			$routejson = $this->Azbn7->parseJSON(file_get_contents($res_file));
			
			if($routejson['redirect'] != '') {
				
				$this->Azbn7->go2($routejson['redirect']);
				
			}/* elseif($routejson['alias'] != '') {
				
				$res = $this->checkRouteJSONExists(explode('/', $routejson['alias']));
				
			} */elseif($routejson['run']['path'] != '') {
				
				if($this->Azbn7->as_int($routejson['entity']['id'])) {
					$routejson['run']['param']['entity'] = $this->Azbn7->mdl('Entity')->item($routejson['entity']['id']);
				}
				
				$this->Azbn7->run('app', 'route/' . $routejson['run']['path'], $routejson['run']['param']);
				
			} else {
				
				$res = false;
				
			}
			
		}
		
		return $res;
		
	}
	
	public function checkFileExists($req)
	{
		
		$res = file_exists($this->Azbn7->config['path']['app'] . '/run/route/' . implode('/', $req) . '.run.php');
		
		if($res) {
			$this->Azbn7->run('app', 'route/' . implode('/', $req), $req);
		}
		
		return $res;
		
	}
	
	public function checkRouteExists($req)
	{
		
		$_req = $req;
		
		$res = false;
		
		while($res != true && count($_req)) {
			$el = array_pop($_req);
			
			$res = file_exists($this->Azbn7->config['path']['app'] . '/run/route/' . implode('/', $_req) . '.run.php');
			
			if($res) {
				$this->Azbn7->run('app', 'route/' . implode('/', $_req), $req);
			}
		}
		
		return $res;
		
	}
	
	public function checkEntityExists($req)
	{
		
		$res = false;
		
		$req_str = implode('/', $req);
		
		$entity = $this->Azbn7->mdl('Entity')->item(0, $req_str);
		
		if(isset($entity['entity']['id'])) {
			$res = true;
			
			$p = array(
				'entity' => $entity,
			);
			
			$this->Azbn7->run('app', 'route/entity/item', $p);
		}
		
		return $res;
		
	}
	
	/*
	public function checkCatExists($req)
	{
		
		$res = false;
		
		return $res;
		
	}
	*/
	
	public function loadURLAlias()
	{
		
		$this->data['alias_arr'] = array();
		
		$alias = $this->Azbn7->mdl('DB')->read('alias', "visible = '10' ORDER BY pos");
		
		if(count($alias)) {
			foreach($alias as $a) {
				$this->data['alias_arr'][$a['find']] = $a['set'];
			}
		}
		
	}
	
	public function checkURLAlias(&$req)
	{
		/*
		function mb_str_split($str) {
			return preg_split('~~u', $str, null, PREG_SPLIT_NO_EMPTY);
		}
		*/
		
		$req_str = implode('/', $req);
		
		if(count($this->data['alias_arr'])) {
			foreach($this->data['alias_arr'] as $k => $v) {
				$req_str = str_replace($k, $v, $req_str); // mb_str_split($v)
			}
		}
		
		$req = explode('/', $req_str);
		
	}
	
	public function checkIsUser(&$req)
	{
		
		if($req[0] == 'admin') {
			$this->Azbn7->mdl('Viewer')->addBodyClass('azbn7-admin');
			$this->Azbn7->mdl('Viewer')->is_admin_tpl = true;
			
			if($this->Azbn7->mdl('Site')->is('user') && $this->Azbn7->mdl('Session')->hasRight('user', 'site.admin.login')) {
				
			} else {
				if($req[1] == 'login') {
					$this->Azbn7->mdl('Viewer')->is_admin_tpl = false;
				} else {
					$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/login/'));
				}
			}
		}
		
	}
	
}