<?

if(count($_POST)) {
	
	if($this->Azbn7->mdl('Session')->login('user', $this->Azbn7->mdl('Req')->_post('login'), $this->Azbn7->mdl('Req')->_post('pass'))) {
		
		if($this->Azbn7->mdl('Session')->hasRight('user', 'site.admin.login')) {
			
			$this->Azbn7->go2('/admin/');
			
		} else {
			
			//sleep(1);
			//var_dump($_SESSION);
			
			$this->Azbn7->go2('/error/403/');
			
		}
		
	} else {
		
		sleep(5);
		
		$this->Azbn7->go2('/error/403/');
		
	}
	
} else {
	
	$this->Azbn7->mdl('Site')
		->render('admin/login', array())
	;
	
}