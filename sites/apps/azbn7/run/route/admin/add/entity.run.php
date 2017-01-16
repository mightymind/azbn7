<?
// получение списка элементов

$type_id = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '$type_id'");

$type['param'] = $this->Azbn7->parseJSON($type['param']);

$this->Azbn7->mdl('Site')
	->render('admin/add/entity', array(
		'type' => $type,
	))
;