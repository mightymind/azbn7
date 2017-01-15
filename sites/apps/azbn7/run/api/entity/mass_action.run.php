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
