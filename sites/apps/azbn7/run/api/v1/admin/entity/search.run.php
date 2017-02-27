<?
/*
основной обработчик API
*/

$text = mb_strtolower($this->Azbn7->mdl('Req')->_post('text'), $this->Azbn7->config['charset']);

$type = $this->Azbn7->mdl('Req')->_post('type');

if($text != '' && mb_strlen($text, $this->Azbn7->config['charset']) > 2) {
	
	// $this->Azbn7->mdl('Entity')->getTable($t['uid'])
	// $this->Azbn7->mdl('DB')->t
	
	if($this->Azbn7->mdl('Site')->is('user')) {
		$visible_str = "(`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible = '10' OR `" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible = '5')";
	} else {
		$visible_str = "`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible = '10'";
	}
	
	$type_str = '';
	
	if($type) {
		
		$type_str = "`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.type = '$type' AND ";
		
	} else {
		
	}
	
	$search_items_sql = $this->Azbn7->mdl('DB')->q("
		SELECT
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.updated_at AS indexed_at,
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.entity,
			`" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`.uid AS entity_type,
			MATCH (`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.content) AGAINST ('$text' IN BOOLEAN MODE) as REL,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.*
		FROM
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`,
			`" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`
		WHERE
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.entity = `" . $this->Azbn7->mdl('DB')->t['entity'] . "`.id
			AND
			$visible_str
			AND
			$type_str
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.type = `" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`.id
			AND
			(
				MATCH (`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.content) AGAINST ('$text' IN BOOLEAN MODE) > 0
				OR
				`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.content LIKE '%$text%'
			)
		ORDER BY
			REL DESC,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.pos,
			indexed_at
	");
	
	$search_items = $search_items_sql->fetchAll(\PDO::FETCH_ASSOC);
	
	$items = array();
	
	if(count($search_items)) {
		$item_arr = '';
		foreach($search_items as $item) {
			$item_arr[] = $item['entity'];
			
			$_item =  array(
				'entity' => $item,
				'item' => $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('Entity')->getTable($item['entity_type']), "entity = '{$item['entity']}'"),
			);
			
			$_item['entity']['link'] = $this->Azbn7->mdl('Site')->url('/' . $_item['entity']['url'] . '/');
			
			$_item['entity']['param'] = $this->Azbn7->parseJSON($_item['entity']['param']);
			$_item['item']['param'] = $this->Azbn7->parseJSON($_item['item']['param']);
			
			$items[] = $_item;
			
		}
	}
	
	$param['response']['entities'] = $items;
	$param['meta']['msg'] = array(
		'type' => 'info',
		'text' => 'searching ' . $text . ' in entities',
	);
	
}
