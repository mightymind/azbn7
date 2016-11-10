<?
class Site
{
	public $event_prefix = 'app.mdl.site';
	public $cache = array();
	
	public function is($type = 'user')
	{
		return isset($_SESSION[$type]['id']) ? $_SESSION[$type]['id'] : 0;
	}
	
	public function getEntityTable($uid = 'page', $sub = '')
	{
		if($sub != '') {
			$sub = '_' . $sub;
		}
		return $this->Azbn7->mdl('DB')->prefix . "_" . $uid . $sub;
	}
	
	public function createEntityType($e = array())
	{
		if(isset($e['uid']) && isset($e['title'])) {
			
			$e['id'] = $this->Azbn7->mdl('DB')->create('entity_type', array('parent' => $this->Azbn7->as_int($e['parent']), 'uid' => $e['uid'], 'title' => $e['title']), true);
			
			if($e['id']) {
				
				$field_str = '';
				$field_arr = array();
				
				if(count($e['field'])) {
					foreach($e['field'] as $k => $v) {
						$field_arr[] = "`$k` $v";
					}
					$field_str = implode(', ', $field_arr);
				}
				
				$this->Azbn7->mdl('DB')
					
					->exec("CREATE TABLE IF NOT EXISTS `" . $this->getEntityTable($e['uid']) . "` (
							`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
							`entity` BIGINT DEFAULT '0',
							{$field_str} ,
							`param` MEDIUMBLOB DEFAULT ''
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;
					")
				;
				
				return $e['id'];
				
			} else {
				
				return 0;
				
			}
			
		} else {
			
			return 0;
			
		}
	}
	
	public function createEntity($e = array(
			'type' => 'page',
			'entity' => array(),
			'item' => array(),
		))
	{
		
		$type = $this->Azbn7->mdl('DB')->one('entity_type', "uid = '{$e['type']}'");
		
		$e['entity']['type'] = $type['id'];
		$e['entity']['created_at'] = $this->Azbn7->created_at;
		$e['entity']['updated_at'] = $this->Azbn7->created_at;
		$e['entity']['user'] = $this->is('user');
		$e['entity']['profile'] = $this->is('profile');
		
		$e['entity']['id'] = $this->Azbn7->mdl('DB')->create('entity', $e['entity']);
		
		if($e['entity']['id']) {
			
			$e['item']['entity'] = &$e['entity']['id'];
			
			$e['item']['id'] = $this->Azbn7->mdl('DB')->create($this->getEntityTable($type['uid']), $e['item']);
			
			if($e['item']['id']) {
				
				return $e['entity']['id'];
				
			} else {
				
				return 0;
				
			}
			
		} else {
			
			return 0;
			
		}
	
	}
	
	public function entity($id = 0, $url = '')
	{
		$entity = array(
			'entity' => array(
				'visible' => 0,
			),
			'type' => array(),
			'item' => array(),
			'cache' => 0,
		);
		
		if(isset($this->cache['entity'][$id]) && is_array($this->cache['entity'][$id])) {
			
			$entity = &$this->cache['entity'][$id];
			
		} else {
			
			if($id) {
				
				$entity['entity'] = $this->Azbn7->mdl('DB')->one('entity', "id = '{$id}'");
				
			} elseif($url != '') {
				
				$entity['entity'] = $this->Azbn7->mdl('DB')->one('entity', "url = '{$url}'");
				
			} else {
				
			}
			
			if(isset($entity['entity']['id'])) {
				
				$id = $entity['entity']['id'];
				
				$entity['entity']['param'] = json_decode($entity['entity']['param']);
				
				$entity['type'] = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$entity['entity']['type']}'");
				if(isset($entity['type']['id'])) {
					$entity['type']['param'] = json_decode($entity['type']['param']);
				}
				
				$entity['item'] = $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('Site')->getEntityTable($entity['type']['uid']), "entity = '{$entity['entity']['id']}'");
				if(isset($entity['item']['id'])) {
					$entity['item']['param'] = json_decode($entity['type']['item']);
				}
				
				$this->cache['entity'][$id] = $entity;
				$this->cache['entity'][$id]['cache'] = 1;
				
			} else {
				
			}
			
		}
		
		return $entity;
	}
	
}