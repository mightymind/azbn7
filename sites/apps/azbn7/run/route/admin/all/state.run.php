<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/state', array(
		'items' => $this->Azbn7->mdl('DB')->read('state'),
	))
;