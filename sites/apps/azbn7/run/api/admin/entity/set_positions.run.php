<?
/*
основной обработчик API
*/

//var_dump($_POST['entities']);

if(count($_POST['entities'])) {
	
	foreach($_POST['entities'] as $entity_id => $entity_pos) {
		
		$entity_id = $this->Azbn7->as_num($entity_id);
		$entity_pos = $this->Azbn7->as_num($entity_pos);
		
		$item = array(
			'pos' => $entity_pos,
		);
		
		$this->Azbn7->mdl('DB')->update('entity', $item, "id = '$entity_id'");
		
		$item['id'] = $entity_id;
		
		$param['response']['entities'][] = $item;
		
	}
	
}

$param['meta']['msg'] = array(
	'type' => 'info',
	'text' => 'reposition of ' . count($_POST['entities']) . ' entities',
);