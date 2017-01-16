<?
class Site
{
	public $event_prefix = 'app.mdl.site';
	public $cache = array();
	public $is_mainpage = false;
	
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
	
	public function selectTheme($theme)
	{
		
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
