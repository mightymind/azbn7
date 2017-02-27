<?
/*
основной обработчик API
*/

$uid = $this->Azbn7->c_s($_POST['uid']);
$value = $this->Azbn7->as_html($_POST['value']);

$uid_arr = explode('.', $uid);

if(count($uid_arr)) {
	
	switch($uid_arr[0]) {
		
		case 'entity' : {
			
			$type = $this->Azbn7->mdl('DB')->one('entity_type', "uid = '{$uid_arr[1]}'");
			
			if($type['id']) {
				
				$item = $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('Entity')->getTable($type['uid']), "id = '{$uid_arr[2]}'");
				
				if($item['id'] && isset($item[$uid_arr[3]])) {
					
					$this->Azbn7->mdl('DB')->update($this->Azbn7->mdl('Entity')->getTable($type['uid']), array(
						$uid_arr[3] => $value,
					), "id = '{$uid_arr[2]}'");
					
					
					/* ---------- ext__event ---------- */
					$this->Azbn7
						->mdl('Ext')
							->event($this->event_prefix . '.app.run.api.azbn7.live-edit.save', $item)
					;
					/* --------- /ext__event ---------- */
					
				}
				
			}
			
		}
		break;
		
		default : {
			
		}
		break;
		
	}
	
}
