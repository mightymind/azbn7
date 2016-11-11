<?

$default = array(
	'max_int' => $this->Azbn7->config['mysql'][0]['max_value']['int'],
	'max_bigint' => $this->Azbn7->config['mysql'][0]['max_value']['bigint'],
);

if(count($this->Azbn7->mdl('DB')->t)) {
	
	$this->Azbn7->mdl('DB')
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['sysopt'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`json` ENUM('0', '1') DEFAULT '0',
				`editable` ENUM('0', '1') DEFAULT '0',
				`uid` VARCHAR(256) NOT NULL UNIQUE,
				`value` MEDIUMBLOB DEFAULT '',
				INDEX uid_index (uid(64))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['sysopt_data'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`uid` VARCHAR(256) NOT NULL UNIQUE,
				`title` VARCHAR(256) DEFAULT '',
				INDEX uid_index (uid(64))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['alias'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`pos` BIGINT DEFAULT '{$default['max_bigint']}',
				`visible` ENUM('0', '1') DEFAULT '1',
				`find` VARCHAR(256) DEFAULT '',
				`set` VARCHAR(256) DEFAULT '',
				`title` VARCHAR(256) DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_type'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`parent` BIGINT DEFAULT '0',
				`uid` VARCHAR(256) NOT NULL UNIQUE,
				`title` VARCHAR(256) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`visible` ENUM('0', '1') DEFAULT '1',
				`type` BIGINT DEFAULT '0',
				`user` BIGINT DEFAULT '0',
				`profile` BIGINT DEFAULT '0',
				`parent` BIGINT DEFAULT '0',
				`pos` BIGINT DEFAULT '{$default['max_bigint']}',
				`created_at` BIGINT DEFAULT '0',
				`updated_at` BIGINT DEFAULT '0',
				`url` TEXT DEFAULT '',
				`param` MEDIUMBLOB DEFAULT '',
				INDEX url_index (url(64)),
				FOREIGN KEY (type) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity_type'] . "(id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['log'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`created_at` BIGINT DEFAULT '0',
				`user` BIGINT DEFAULT '0',
				`profile` BIGINT DEFAULT '0',
				`entity` BIGINT DEFAULT '0',
				`uid` VARCHAR(256) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT '',
				INDEX uid_index (uid(64)),
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_bound'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`parent` BIGINT DEFAULT '0',
				`child` BIGINT DEFAULT '0',
				INDEX parent_index (`parent`),
				INDEX child_index (`child`),
				FOREIGN KEY (parent) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_data'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`json` ENUM('0', '1') DEFAULT '0',
				`entity` BIGINT DEFAULT '0',
				`uid` VARCHAR(256) DEFAULT '',
				`value` MEDIUMBLOB DEFAULT '',
				INDEX main_index (entity, uid(64)),
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_search'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`entity` BIGINT DEFAULT '0',
				`created_at` BIGINT DEFAULT '0',
				`updated_at` BIGINT DEFAULT '0',
				`content` LONGTEXT DEFAULT '',
				INDEX by_entity (`entity`),
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE,
				FULLTEXT KEY `search` (`content`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
	;
	
	$this->Azbn7->mdl('Site')
		->log('site.db.create_tables', array(
			
		))
	;
	
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'azbn7.created_at', 'title' => 'Дата и время инсталяции сайта'));
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'azbn7.updated_at', 'title' => 'Дата и время последнего обновления'));
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'azbn7.install_version', 'title' => 'Версия движка Azbn7 при установке'));
	
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 0, 'uid' => 'azbn7.created_at', 'value' => $this->Azbn7->created_at));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 0, 'uid' => 'azbn7.updated_at', 'value' => $this->Azbn7->created_at));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 0, 'uid' => 'azbn7.version', 'value' => $this->Azbn7->version['number']));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_sysopt', array(
			
		))
	;
	
	
	$t['page'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => 0,
		'uid' => 'page',
		'title' => 'Страница',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'preview' => "TEXT DEFAULT ''",
			'content' => "MEDIUMTEXT DEFAULT ''",
		),
	));
	
	$t['category'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => 0,
		'uid' => 'category',
		'title' => 'Категория',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'preview' => "TEXT DEFAULT ''",
			'content' => "MEDIUMTEXT DEFAULT ''",
		),
	));
	
	$t['upload'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => 0,
		'uid' => 'upload',
		'title' => 'Загруженный файл',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'path' => "TEXT DEFAULT ''",
		),
	));
	
	$t['img'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => $t['upload'],
		'uid' => 'img',
		'title' => 'Изображение',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'path' => "TEXT DEFAULT ''",
		),
	));
	
	$t['audio'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => $t['upload'],
		'uid' => 'audio',
		'title' => 'Аудио',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'path' => "TEXT DEFAULT ''",
		),
	));
	
	$t['video'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => $t['upload'],
		'uid' => 'video',
		'title' => 'Видео',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'path' => "TEXT DEFAULT ''",
		),
	));
	
	$t['file'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => $t['upload'],
		'uid' => 'file',
		'title' => 'Файл любого формата',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'path' => "TEXT DEFAULT ''",
		),
	));
	
	$t['youtube'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => $t['video'],
		'uid' => 'youtube',
		'title' => 'Видео YouTube',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'yt_uid' => "VARCHAR(256) DEFAULT ''",
		),
	));
	
	$t['link'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => 0,
		'uid' => 'link',
		'title' => 'Ссылка',
		'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'path' => "TEXT DEFAULT ''",
		),
	));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_entity_types', array(
			
		))
	;
	
	
	
	$this->Azbn7->mdl('DB')->create('alias', array('pos' => 0, 'find' => 'установлено', 'set' => 'install/installed', 'title' => 'Страница информации после установки'));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_aliases', array(
			
		))
	;
	
	
	$e = array();
	$b = array();
	
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 1,
			'parent' => 0,
			'pos' => 0,
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'mainpage',
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'title' => 'Главная страница',
			'preview' => 'Краткое описание',
			'content' => 'Полный текст',
			'param' => $this->Azbn7->arr2json(array()),
		),
	));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_entity', array(
			'entity' => $e[0],
			'title' => 'Создание главной страницы',
		))
	;
	
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 1,
			'parent' => 0,
			'pos' => $default['max_bigint'],
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'помощь',
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'title' => 'Страница помощи',
			'preview' => 'Что делать после установки',
			'content' => '<p>Полный текст страницы помощи</p>',
			'param' => $this->Azbn7->arr2json(array()),
		),
	));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_entity', array(
			'entity' => $e[1],
			'title' => 'Создание страницы помощи',
		))
	;
	
	$b[] = $this->Azbn7->mdl('Entity')->createBound(array(
		'parent' => $e[0],
		'child' => $e[1],
	));
	
	$this->Azbn7->event(array(
		'action' => 'app.run.route.install.main.after',
		'title' => 'Установка основных таблиц базы данных MySQL',
	));
	
	$this->Azbn7->go2('/установлено/');
	
}