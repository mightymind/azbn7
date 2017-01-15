<?
/*
основной обработчик API
*/

$action = $this->Azbn7->mdl('Req')->_post('action');
$ids = $this->Azbn7->mdl('Req')->_post('ids');

$ids_arr = explode(',', $ids);

if(count($ids_arr)) {
	
	switch($action) {
		
		case 'delete' : {
			
			foreach($ids_arr as $item_id) {
				
				$item = $this->Azbn7->mdl('DB')->one('entity', "id = '{$item_id}'");
				
				if($item['locked_by'] == 0) {
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.not_author.delete') || $this->Azbn7->mdl('Site')->is('user') == $item['user']) {
						$this->Azbn7->mdl('DB')->delete('entity', "id = '{$item_id}' AND locked_by = '0'");
						
						$this->Azbn7->mdl('Site')
							->log('site.entity.delete', array(
								'entity' => $item_id,
							))
						;
					}
				}
				
			}
			
		}
		break;
		
		case 'visible=0' :
		case 'visible=5' :
		case 'visible=10' : {
			
			$action_p = explode('=', $action);
			$visible = $this->Azbn7->as_num($action_p[1]);
			
			foreach($ids_arr as $item_id) {
				
				$item = $this->Azbn7->mdl('DB')->one('entity', "id = '{$item_id}'");
				
				if($item['locked_by'] == 0) {
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.not_author.update') || $this->Azbn7->mdl('Site')->is('user') == $item['user']) {
						
						$entity_arr = array(
							'visible' => $visible,
						);
						
						$this->Azbn7->mdl('DB')->update('entity', $entity_arr, "id = '{$item_id}' AND locked_by = '0'");
					}
				}
				
			}
			
		}
		break;
		
		case 'lock' : {
			
			if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
				foreach($ids_arr as $item_id) {
					
					$entity_arr = array(
						'locked_by' => $this->Azbn7->mdl('Site')->is('user'),
					);
					
					$this->Azbn7->mdl('DB')->update('entity', $entity_arr, "id = '{$item_id}'");
					
					$this->Azbn7->mdl('Site')
						->log('site.entity.lock', array(
							'entity' => $item_id,
						))
					;
					
				}
			}
			
		}
		break;
		
		case 'unlock' : {
			
			if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
				foreach($ids_arr as $item_id) {
					
					$entity_arr = array(
						'locked_by' => 0,
					);
					
					$this->Azbn7->mdl('DB')->update('entity', $entity_arr, "id = '{$item_id}'");
					
					$this->Azbn7->mdl('Site')
						->log('site.entity.unlock', array(
							'entity' => $item_id,
						))
					;
					
				}
			}
			
		}
		break;
		
		default : {
			
		}
		break;
		
	}
	
}

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
	$search_items = $search_items_sql->fetchAll(PDO::FETCH_ASSOC);
	
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
			
			$_item['entity']['param'] = json_decode($_item['entity']['param'], true);
			$_item['item']['param'] = json_decode($_item['item']['param'], true);
			
			$items[] = $_item;
			
		}
	}
	
	$param['response']['entities'] = $items;
	$param['meta']['msg'] = array(
		'type' => 'info',
		'text' => 'searching bu id ( ' . $text . ' ) in entities',
	);
	
}
