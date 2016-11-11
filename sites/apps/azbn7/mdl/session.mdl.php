<?
class Session
{
	public $event_prefix = 'app.mdl.session';
	public $cache = array();
	
	public function is($type = 'user')
	{
		return $this->Azbn7->as_int(isset($_SESSION[$type]['id']) ? $_SESSION[$type]['id'] : 0);
	}
	
	public function login($type = 'user', $login = '', $pass = '')
	{
		$pass_hash = $this->getPassHash($pass, $type, $login);
		
		$item = $this->Azbn7->mdl('DB')->one($type, "login = '{$login}' AND pass = '{$pass_hash}' AND status > '0'");
		
		if($item['id']) {
			
			$item['param'] = json_decode($item['param']);
			
			$_SESSION[$type] = $item;
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.' . $type . '.login',
				'title' => 'Сессия: вход ' . $type . ' ' . $item['id'],
			));
			
			$this->Azbn7->mdl('Site')
				->log('site.session.' . $type . '.login', array(
					
				))
			;
			
		} else {
			$this->logout($type);
		}
		
		return $this->is($type);
	}
	
	public function logout($type = 'user')
	{
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.' . $type . '.logout',
			'title' => 'Сессия: выход ' . $type . ' ' . $_SESSION[$type]['id'],
		));
		
		$this->Azbn7->mdl('Site')
			->log('site.session.' . $type . '.logout', array(
				
			))
		;
		
		unset($_SESSION[$type]);
	}
	
	public function getPassHash($pass = '', $type = '', $login = '')
	{
		return $this->Azbn7->hash($pass, $type, $login);
	}
	
}