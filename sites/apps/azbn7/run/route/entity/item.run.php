<?

$entity = $param['entity'];

var_dump($entity);

$entity2 = $this->Azbn7->mdl('Site')->entity($entity['entity']['id']);

var_dump($entity2);