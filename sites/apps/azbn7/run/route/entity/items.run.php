<?
/*
$entity = $param['entity'];

var_dump($entity);

$entity2 = $this->Azbn7->mdl('Entity')->item($entity['entity']['id']);

var_dump($entity2);
*/

var_dump(($this->Azbn7->mdl('Entity')->getItems('page', "`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.id = '1'")));
