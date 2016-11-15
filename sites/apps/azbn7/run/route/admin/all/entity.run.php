<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/entity', array(
		'items' => $this->Azbn7->mdl('DB')->read('entity', "1 ORDER BY id DESC"),
	))
;