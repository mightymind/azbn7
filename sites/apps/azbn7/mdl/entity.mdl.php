<?
class Entity
{
	public $event_prefix = 'app.mdl.entity';
	public $cache = array();
	
	public function getTable($uid = 'page', $sub = '')
	{
		if($sub != '') {
			$sub = '_' . $sub;
		}
		return $this->Azbn7->mdl('DB')->prefix . "_" . $uid . $sub;
	}
	
	public function createType($e = array())
	{
		if(isset($e['uid']) && isset($e['title'])) {
			
			$field_struct_arr = array();
			
			if(count($e['field'])) {
				foreach($e['field'] as $k => $v) {
					$field_struct_arr[$k] = array(
						//'type' => $this->Azbn7->c_s($v['type']),
						'editor' => $this->Azbn7->c_s($v['editor']),
						'title' => $this->Azbn7->c_s($v['title']),
					);
				}
			}
			
			$e['id'] = $this->Azbn7->mdl('DB')->create('entity_type', array(
				'parent' => $this->Azbn7->as_num($e['parent']),
				'uid' => $e['uid'],
				'title' => $e['title'],
				'param' => $this->Azbn7->arr2json(array(
					'field' => $field_struct_arr,
				)),
			), true);
			
			if($e['id']) {
				
				$field_str = '';
				$field_arr = array();
				
				if(count($e['field'])) {
					foreach($e['field'] as $k => $v) {
						$field_arr[] = "`$k` {$v['type']}";
					}
					$field_str = implode(', ', $field_arr);
				}
				
				$this->Azbn7->mdl('DB')
					
					->exec("CREATE TABLE IF NOT EXISTS `" . $this->getTable($e['uid']) . "` (
							`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
							`entity` BIGINT DEFAULT '0',
							`title` VARCHAR(256) DEFAULT '',
							{$field_str} ,
							`param` MEDIUMBLOB DEFAULT '',
							FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;
					")
				;
				
				/*
				$this->Azbn7->mdl('DB')->update('entity_type', array('param' => array(
					'field' => array(
						
					))));
				*/
				
				$this->Azbn7->event(array(
					'action' => $this->event_prefix . '.create.entity_type.after',
					'title' => 'Сущности: создание типа',
				));
				
				$this->Azbn7->mdl('Site')
					->log('site.entity.create.entity_type', array(
						'id' => $e['id'],
						'uid' => $e['uid'],
					))
				;
				
				$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity.type.' . $e['uid'] . '.access', 'title' => 'Доступ к записям типа ' . $e['title']));
				
				return intval($e['id']);
				
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
		$e['entity']['user'] = $this->Azbn7->mdl('Site')->is('user');
		$e['entity']['profile'] = $this->Azbn7->mdl('Site')->is('profile');
		
		$e['entity']['id'] = $this->Azbn7->mdl('DB')->create('entity', $e['entity']);
		
		if($e['entity']['id']) {
			
			$e['item']['entity'] = &$e['entity']['id'];
			
			$e['item']['id'] = $this->Azbn7->mdl('DB')->create($this->getTable($type['uid']), $e['item']);
			
			if($e['item']['id']) {
				
				$this->Azbn7->run('app', 'search/entity/reindex', $e);
				
				$this->Azbn7->event(array(
					'action' => $this->event_prefix . '.create.entity.after',
					'title' => 'Сущности: создание записи',
				));
				
				$this->Azbn7->mdl('Site')
					->log('site.entity.create.entity', array(
						'entity' => $e['entity']['id'],
					))
				;
				
				return intval($e['entity']['id']);
				
			} else {
				
				return 0;
				
			}
			
		} else {
			
			return 0;
			
		}
	
	}
	
	public function createBound($b = array(
		'parent' => 0,
		'child' => 0,
	))
	{
		$res = 0;
		
		$bound = $this->Azbn7->mdl('DB')->one('entity_bound', "parent = '{$b['parent']}' AND child = '{$b['child']}'");
		
		if($bound['id']) {
			
			$res = intval($bound['id']);
			
		} else {
			
			$b['id'] = $this->Azbn7->mdl('DB')->create('entity_bound', $b);
			
			$res = intval($b['id']);
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.create.entity_bound.after',
				'title' => 'Сущности: создание связи между записями',
			));
			
			$this->Azbn7->mdl('Site')
				->log('site.entity.create.entity_bound', array(
					'entity' => $b['parent'],
					'parent' => $b['parent'],
					'child' => $b['child'],
					'id' => $b['id'],
				))
			;
			
		}
		
		return $res;
		
	}
	
	public function url($id = 0)
	{
		$entity = array();
		$res = '';
		
		if(isset($this->cache[$id]) && is_array($this->cache[$id])) {
			
			$entity = &$this->cache[$id];
			
		} else {
			
			$entity['entity'] = $this->Azbn7->mdl('DB')->one('entity', "id = '$id'");
			
		}
		
		if($entity['entity']['id']) {
			$res = '/' . $entity['entity']['url'] . '/';
		}
		
		return $res;
	}
	
	public function item($id = 0, $url = '')
	{
		$entity = array(
			'entity' => array(
				'visible' => 0,
			),
			'type' => array(),
			'item' => array(),
			'cache' => 0,
		);
		
		if(isset($this->cache[$id]) && is_array($this->cache[$id])) {
			
			$entity = &$this->cache[$id];
			
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
					$entity['type']['param'] = json_decode($entity['type']['param'], true);
				}
				
				$entity['item'] = $this->Azbn7->mdl('DB')->one($this->getTable($entity['type']['uid']), "entity = '{$entity['entity']['id']}'");
				if(isset($entity['item']['id'])) {
					$entity['item']['param'] = json_decode($entity['item']['param'], true);
				}
				
				$this->cache[$id] = $entity;
				$this->cache[$id]['cache'] = 1;
				
			} else {
				
			}
			
		}
		
		if($this->Azbn7->mdl('Site')->is('user')) {
			
		} elseif($entity['entity']['visible']) {
			
		} else {
			$entity = array();
		}
		
		return $entity;
	}
	
	public function updateEntity($id = 0, $e = array('entity' => array(), 'item' => array(),))
	{
		
		$entity = $this->Azbn7->mdl('DB')->one('entity', "id = '$id'");
		
		if($entity['id']) {
			
			$this->Azbn7->mdl('DB')->update('entity', $e['entity'], "id = '$id'");
			
			$e['entity']['id'] = $entity['id'];
			
			$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$entity['type']}'");
			
			if($type['id']) {
				
				$this->Azbn7->mdl('DB')->update($this->getTable($type['uid']), $e['item'], "entity = '$id'");
				
				$this->Azbn7->run('app', 'search/entity/reindex', $e);
				
			}
			
		}
		
	}
	
	public function deleteEntity($id = 0)
	{
		
		$entity = $this->Azbn7->mdl('DB')->one('entity', "id = '$id'");
		
		if($entity['id']) {
			
			$this->Azbn7->mdl('DB')->delete('entity', "id = '$id'");
			
			$type = $this->Azbn7->mdl('DB')->one('type', "id = '{$entity['type']}'");
			
			if($type['id']) {
				
				$this->Azbn7->mdl('DB')->delete($this->getTable($type['uid']), "entity = '$id'");
				
			}
			
		}
		
	}
	
}