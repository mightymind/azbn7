<?
class Site
{
	public $event_prefix = 'app.mdl.site';
	public $cache = array();
	
	public function is($type = 'user')
	{
		return $this->Azbn7->as_int(isset($_SESSION[$type]['id']) ? $_SESSION[$type]['id'] : 0);
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
			'param' => $this->Azbn7->arr2json($p),
		);
		
		return $this->Azbn7->mdl('DB')->create('log', $item);
	}
	
	public function render($tpl = 'default', $p)
	{
		$this->Azbn7->mdl('Viewer')
			->tpl('_/header', $p);
		
		$this->Azbn7->mdl('Viewer')
			->tpl($tpl, $p);
		
		$this->Azbn7->mdl('Viewer')
			->tpl('_/footer', $p);
	}
	
}