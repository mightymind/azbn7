<?

/*
array(
		'item' => $this->Azbn7->mdl('Entity')->item($param[3], ''),
	)
*/

$this->Azbn7->mdl('Site')
	->render('admin/edit/entity', $this->Azbn7->mdl('Entity')->item($param[3], ''))
;
