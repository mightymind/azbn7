<?
class AppRouter
{
	public $event_prefix = 'app.mdl.approuter';
	
	public function route($req = array())
	{
		
		$_req = $req;
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.route.before',
			'title' => 'Событие роутера: ДО обработки',
		));
		
		if(count($req)) {
			
			//var_dump($this->Azbn7->data['mdl']['Req']['req_url']);
			
			$this->loadURLAlias();
			
			$this->checkURLAlias($req);
			
			if(count($_POST)) {
				
			}
			
			if($this->checkFileExists($req)) {
				
				
				
			} elseif($this->checkRouteExists($req)) {
				
			} elseif($this->checkEntityExists($req)) {
				
			} else {
				
				$this->page404($req);
				
			}
			
		} else {
			
			$this->Azbn7->run('app', 'route/index', $_req);
			
		}
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.route.after',
			'title' => 'Событие роутера: ПОСЛЕ обработки',
		));
		
	}
	
	public function page404($req)
	{
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.page404',
			'title' => 'Событие роутера: Страница не найдена',
		));
		
		$this->Azbn7->run('app', 'route/404/index', $req);
		
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
		
		//$item = $this->Azbn7->mdl('DB')->one('route', "url = '$url'");
		
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
		
		//$item = $this->Azbn7->mdl('DB')->one('route', "url = '$url'");
		
		$res = false;
		
		$req_str = implode('/', $req);
		
		$entity = $this->Azbn7->mdl('Entity')->get(0, $req_str);
		
		if(isset($entity['entity']['id'])) {
			$res = true;
			
			$p = array(
				'entity' => $entity,
			);
			
			$this->Azbn7->run('app', 'route/entity/item', $p);
		}
		
		return $res;
		
	}
	
	public function loadURLAlias()
	{
		
		$this->data['alias_arr'] = array();
		
		$alias = $this->Azbn7->mdl('DB')->read('alias', 'visible = 1 ORDER BY pos');
		
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
	
}