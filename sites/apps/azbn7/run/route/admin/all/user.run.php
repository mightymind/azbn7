<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/user', array(
		'items' => $this->Azbn7->mdl('DB')->read('user', "1 ORDER BY id DESC"),
	))
;