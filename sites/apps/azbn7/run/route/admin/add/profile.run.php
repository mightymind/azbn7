<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/add/profile', array(
		//'entities' => $this->Azbn7->mdl('DB')->read('sysopt'),
		//'rights' => $this->Azbn7->mdl('DB')->read('right', '1 ORDER BY uid'),
	))
;