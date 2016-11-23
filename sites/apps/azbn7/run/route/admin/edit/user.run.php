<?

$this->Azbn7->mdl('Site')
	->render('admin/edit/user', array(
		'item' => $this->Azbn7->mdl('DB')->one('user', "id = '{$param[3]}'"),
	))
;
