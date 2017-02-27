<?
/*
основной обработчик API
*/

$text = mb_strtolower($this->Azbn7->mdl('Req')->_post('text'), $this->Azbn7->config['charset']);

/*
$text = explode(',', $text);
if(count($text)) {
	foreach($text as $k => $v) {
		if($this->Azbn7->as_int($v) != 0) {
			$text[$k] = "'$v'";
		} else {
			unset($text[$k]);
		}
	}
}
$text = implode(',', $text);
*/

$type = $this->Azbn7->mdl('Req')->_post('type');

if($text != '' && mb_strlen($text, $this->Azbn7->config['charset']) > 2) {
	
	// $this->Azbn7->mdl('Entity')->getTable($t['uid'])
	// $this->Azbn7->mdl('DB')->t
	
	if($this->Azbn7->mdl('Site')->is('user')) {
		$visible_str = "'5','10'";
	} else {
		$visible_str = "'10'";
	}
	
	$type_str = '';
	
	if($type) {
		
		$type_str = "`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.type = '$type' AND ";
		
	} else {
		
	}
	
	$search_items_sql = $this->Azbn7->mdl('DB')->q("
		SELECT
			`" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`.uid AS entity_type,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.*
		FROM
			`" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`
		WHERE
			$type_str
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible IN ($visible_str)
			AND
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.type = `" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`.id
			AND
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.id IN ($text)
		ORDER BY
			FIELD(`azbn7_entity`.id, $text)
	");/*ORDER BY
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.id*/
	//die($text);
	$search_items = $search_items_sql->fetchAll(\PDO::FETCH_ASSOC);
	
	$items = array();
	
	if(count($search_items)) {
		$item_arr = '';
		foreach($search_items as $item) {
			$item_arr[] = $item['id'];
			
			$_item =  array(
				'entity' => $item,
				'item' => $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('Entity')->getTable($item['entity_type']), "entity = '{$item['id']}'"),
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
		'text' => 'searching bu id ( ' . $text . ' ) in entities',
	);
	
}
