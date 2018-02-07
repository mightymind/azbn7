<?php

namespace app;

class Session
{
	public $event_prefix = '';//'app.mdl.session';
	public $cache = array();
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	/*
	public function is($type = 'user')
	{
		return $this->Azbn7->as_num(isset($_SESSION[$type]['id']) ? $_SESSION[$type]['id'] : 0);
	}
	*/
	
	public function login($type = 'user', $login = '', $pass = '')
	{
		$pass_hash = $this->getPassHash($pass, $type, $login);
		
		$item = $this->Azbn7->mdl('DB')->one($type, "login = '{$login}' AND pass = '{$pass_hash}' AND status > '0'");
		
		if($item['id']) {
			
			$item['right'] = $this->Azbn7->parseJSON($item['right']);
			$item['param'] = $this->Azbn7->parseJSON($item['param']);
			
			$_SESSION[$type] = $item;
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.' . $type . '.login',
				'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.' .$type . '.login'),
			));
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.' . $type . '.login.after', $item)
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->mdl('Site')
				->log('site.session.' . $type . '.login', array(
					
				))
			;
			
		} else {
			
			$this->logout($type);
			
		}
		
		return $this->Azbn7->mdl('Site')->is($type);
	}
	
	public function logout($type = 'user')
	{
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.' . $type . '.logout',
			'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.' .$type . '.logout'),
		));
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.' . $type . '.logout.before', $type)
		;
		/* --------- /ext__event ---------- */
		
		
		$this->Azbn7->mdl('Site')
			->log('site.session.' . $type . '.logout', array(
				
			))
		;
		
		unset($_SESSION[$type]);
	}
	
	public function hasRole($profile_id = 0, $role_id = 0, $type = 'user')
	{
		
	}
	
	public function getPassHash($pass = '', $type = '', $login = '')
	{
		return $this->Azbn7->hash($pass, $type, $login);
	}
	
	public function notify($type = 'user', $notify = array())
	{
		$_SESSION['tmp']['notify'][$type][] = $notify;
	}
	
	public function getNotifies($type = 'user', $clear = true)
	{
		if(isset($_SESSION['tmp'])) {
			$n = $_SESSION['tmp']['notify'][$type];
			
			if($clear) {
				unset($_SESSION['tmp']['notify'][$type]);
			}
			
			return $n;
		} else {
			return null;
		}
	}
	
	public function hasRight($type = 'user', $right = '')
	{
		if(isset($_SESSION[$type]['right'][$right])) {
			$__res = $_SESSION[$type]['right'][$right];
		} else {
			$__res = 0;
		}
		return $this->Azbn7->as_int($__res);
	}
	
	public function reloadRights($type = 'user')
	{
		$item = $this->Azbn7->mdl('DB')->one($type, "id = '" . $_SESSION[$type]['id'] . "'");
		
		if($item['id']) {
			
			$_SESSION[$type]['right'] = $this->Azbn7->parseJSON($item['right']);
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.reloadRights.after', $type)
			;
			/* --------- /ext__event ---------- */
			
			
		}
		
	}
	
}