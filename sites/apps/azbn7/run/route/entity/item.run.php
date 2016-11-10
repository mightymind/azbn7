<?
/*
$entity = $param['entity'];

var_dump($entity);

$entity2 = $this->Azbn7->mdl('Entity')->get($entity['entity']['id']);

var_dump($entity2);
*/

$this->Azbn7->mdl('Site')
	->render('entity/item', $param)
;