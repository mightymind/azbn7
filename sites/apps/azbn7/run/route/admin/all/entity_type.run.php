<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/entity_type', array(
		'items' => $this->Azbn7->mdl('DB')->read('entity_type'),
	))
;