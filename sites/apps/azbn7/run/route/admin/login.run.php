<?

if(count($_POST)) {
	
	if($this->Azbn7->mdl('Session')->login('user', $this->Azbn7->mdl('Req')->_post('login'), $this->Azbn7->mdl('Req')->_post('pass'))) {
		
		if($this->Azbn7->mdl('Session')->hasRight('user', 'site.admin.login')) {
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.app.run.route.admin.login.hasRight')
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/'));
			
		} else {
			
			//sleep(1);
			//var_dump($_SESSION);
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.app.run.route.admin.login.not_hasRight')
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/error/403/'));
			
		}
		
	} else {
		
		
		/* ---------- ext__event ---------- */
		$this->Azbn7
			->mdl('Ext')
				->event($this->event_prefix . '.app.run.route.admin.login.not_login')
		;
		/* --------- /ext__event ---------- */
		
		
		sleep(5);
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/error/403/'));
		
	}
	
} else {
	
	$this->Azbn7->mdl('Site')
		->render('admin/login', array())
	;
	
}