<?

$this->Azbn7->mdl('Site')
	->render('admin/edit/entity_seo', array(
		'entity' => $this->Azbn7->mdl('Entity')->item($param[3]),
		'item' => $this->Azbn7->mdl('DB')->one('entity_seo', "entity = '{$param[3]}'"),
	))
;
