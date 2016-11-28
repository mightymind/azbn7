<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/profile', array(
		'items' => $this->Azbn7->mdl('DB')->read('profile', "1 ORDER BY id DESC"),
	))
;