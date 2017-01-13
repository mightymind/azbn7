<?

$this->Azbn7->mdl('Site')
	->render('admin/edit/right', array(
		'item' => $this->Azbn7->mdl('DB')->one('right', "id = '{$param[3]}'"),
	))
;
