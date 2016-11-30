<?
/*
$entity = $param['entity'];

var_dump($entity);

$entity2 = $this->Azbn7->mdl('Entity')->item($entity['entity']['id']);

var_dump($entity2);
*/

if($param['entity']['type']['id'] == 1) {
	
	$this->Azbn7->mdl('Site')
		->render('entity/by_type/page', $param)
	;
	
} else {
	echo 'Это не страница!';
}