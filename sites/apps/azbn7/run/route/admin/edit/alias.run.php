<?

$this->Azbn7->mdl('Site')
	->render('admin/edit/sysopt', array(
		'item' => $this->Azbn7->mdl('DB')->one('alias', "id = '{$param[3]}'"),
	))
;
