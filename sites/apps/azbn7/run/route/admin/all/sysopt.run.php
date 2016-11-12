<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/sysopt', array(
		'items' => $this->Azbn7->mdl('DB')->read('sysopt'),
	))
;