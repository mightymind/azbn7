<?

$default = array(
	'max_int' => $this->Azbn7->config['mysql'][0]['max_value']['int'],
	'max_bigint' => $this->Azbn7->config['mysql'][0]['max_value']['bigint'],
);

$this->Azbn7->mdl('Session')->logout('user');
$this->Azbn7->mdl('Session')->logout('profile');

if(count($this->Azbn7->mdl('DB')->t)) {
	
	$this->Azbn7->mdl('DB')
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['sysopt'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`json` ENUM('0', '1') DEFAULT '0',
				`editable` ENUM('0', '1') DEFAULT '0',
				`uid` VARCHAR(256) NOT NULL UNIQUE,
				`editor` VARCHAR(256) DEFAULT 'input',
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
				`visible` ENUM('0', '10') DEFAULT '10',
				`find` VARCHAR(256) DEFAULT '',
				`set` VARCHAR(256) DEFAULT '',
				`title` VARCHAR(256) DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['right'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`uid` VARCHAR(256) NOT NULL UNIQUE,
				`title` VARCHAR(256) DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_type'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`fill` ENUM('0', '1') DEFAULT '1',
				`parent` BIGINT DEFAULT '0',
				`uid` VARCHAR(256) NOT NULL UNIQUE,
				`title` VARCHAR(256) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`visible` ENUM('0', '5', '10') DEFAULT '10',
				`locked_by` BIGINT DEFAULT '0',
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
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_seo'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`entity` BIGINT DEFAULT '0',
				`title` VARCHAR(256) DEFAULT '',
				`description` VARCHAR(256) DEFAULT '',
				`keywords` VARCHAR(256) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT '',
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
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
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['user'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`status` TINYINT DEFAULT '1',
				`created_at` BIGINT DEFAULT '0',
				`login` VARCHAR(64) NOT NULL UNIQUE,
				`pass` VARCHAR(64) DEFAULT '',
				`email` VARCHAR(256) DEFAULT '',
				`right` MEDIUMBLOB DEFAULT '',
				`param` MEDIUMBLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['profile'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`status` TINYINT DEFAULT '1',
				`created_at` BIGINT DEFAULT '0',
				`login` VARCHAR(64) NOT NULL UNIQUE,
				`pass` VARCHAR(64) DEFAULT '',
				`email` VARCHAR(256) DEFAULT '',
				`right` MEDIUMBLOB DEFAULT '',
				`param` MEDIUMBLOB DEFAULT ''
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
				FULLTEXT KEY `content_search` (`content`)
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
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'site.default.theme', 'title' => 'Тема сайта по умолчанию'));
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'site.sitemap.types', 'title' => 'Типы сущностей, доступных в sitemap.xml'));
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'site.robots.content', 'title' => 'Содержимое файла robots.txt'));
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'site.counters.content', 'title' => 'Код счетчиков'));
	$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => 'site.admin.editors', 'title' => 'Редакторы контента'));
	
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 0, 'editor' => 'input', 'uid' => 'azbn7.created_at', 'value' => $this->Azbn7->created_at));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 0, 'editor' => 'input', 'uid' => 'azbn7.updated_at', 'value' => $this->Azbn7->created_at));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 0, 'editor' => 'input', 'uid' => 'azbn7.install_version', 'value' => $this->Azbn7->version['number']));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 1, 'editor' => 'input', 'uid' => 'site.default.theme', 'value' => $this->Azbn7->config['theme']));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 1, 'editor' => 'input', 'uid' => 'site.sitemap.types', 'value' => '1,2'));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 1, 'editor' => 'textarea', 'uid' => 'site.robots.content', 'value' => "User-agent: *\nDisallow: /\n"));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 0, 'editable' => 1, 'editor' => 'textarea', 'uid' => 'site.counters.content', 'value' => '<!-- код счетчиков -->'));
	$this->Azbn7->mdl('DB')->create('sysopt', array('json' => 1, 'editable' => 1, 'editor' => 'textarea', 'uid' => 'site.admin.editors', 'value' => $this->Azbn7->getJSON(array(
													'input' => 'Текстовое поле ввода',
													'textarea' => 'Многострочное поле',
													'pos' => 'Позиция',
													'email' => 'Email',
													'hidden' => 'Скрытое поле',
													'pass' => 'Пароль',
													'visible' => 'Флаг доступности на сайте',
													'wysiwyg' => 'Визуальный редактор',
													'gallery-collect' => 'Контейнер изображений',
													'entity-autocomplete-single' => 'Поиск и выбор записи',
													'entity-autocomplete' => 'Поиск и выбор записей (несколько)',
													'upload' => 'Загрузка файлов',
													'uploadimg' => 'Загрузка изображений',
													'uploadvideo' => 'Загрузка видео',
													'uploadaudio' => 'Загрузка аудио',
													'sysopt/json' => 'Флаг JSON',
													'sysopt/editable' => 'Флаг возможности редактирования',
													'yandex-maps-editor-area' => 'Редактор области на Яндекс.Карте',
													'yandex-maps-editor-point' => 'Редактор метки на Яндекс.Карте',
												))
											));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_sysopt', array(
			
		))
	;
	
	
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.admin.login', 'title' => 'Доступ к админке'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.upload', 'title' => 'Загрузка файлов на сервер'));
	
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.user.all.access', 'title' => 'Доступ к списку администраторов'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.user.item.right.access', 'title' => 'Доступ к правам администраторов'));
	
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.profile.all.access', 'title' => 'Доступ к списку профилей'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.profile.item.right.access', 'title' => 'Доступ к правам профилей'));
	
	
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.right.all.access', 'title' => 'Доступ к списку прав'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.sysopt.all.access', 'title' => 'Доступ к настройкам сайта'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity_type.all.access', 'title' => 'Доступ к типам данных'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.alias.all.access', 'title' => 'Доступ к перенаправлениям'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.log.all.access', 'title' => 'Доступ к логам'));
	
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity.copy', 'title' => 'Копирование записей'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity.lock', 'title' => 'Блокирование записей от изменений'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity.not_author.update', 'title' => 'Редактирование чужих записей'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity.not_author.delete', 'title' => 'Удаление чужих записей'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity_seo.access', 'title' => 'Изменение SEO-настроек записей'));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_right', array(
			
		))
	;
	
	/*
	$t['page'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 1,
		'parent' => 0,
		'uid' => 'page',
		'title' => 'Страница',
		'field' => array(
			'preview' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'textarea',
				'title' => 'Краткое описание',
			),
			'content' => array(
				'type' => "MEDIUMTEXT DEFAULT ''",
				'editor' => 'wysiwyg',
				'title' => 'Основное содержание',
			),
		),
	));
	
	$t['category'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 1,
		'parent' => 0,
		'uid' => 'category',
		'title' => 'Категория',
		'field' => array(
			'preview' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'textarea',
				'title' => 'Краткое описание',
			),
			'content' => array(
				'type' => "MEDIUMTEXT DEFAULT ''",
				'editor' => 'wysiwyg',
				'title' => 'Основное содержание',
			),
		),
	));
	
	$t['upload'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 0,
		'parent' => 0,
		'uid' => 'upload',
		'title' => 'Загруженный файл',
		'field' => array(
			'path' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'upload',
				'title' => 'Путь до файла',
			),
		),
	));
	
	$t['img'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 1,
		'parent' => $t['upload'],
		'uid' => 'img',
		'title' => 'Изображение',
		'field' => array(
			'path' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'uploadimg',
				'title' => 'Путь до файла',
			),
		),
	));
	
	$t['audio'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 1,
		'parent' => $t['upload'],
		'uid' => 'audio',
		'title' => 'Аудио',
		'field' => array(
			'path' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'uploadaudio',
				'title' => 'Путь до файла',
			),
		),
	));
	
	$t['video'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 1,
		'parent' => $t['upload'],
		'uid' => 'video',
		'title' => 'Видео',
		'field' => array(
			'path' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'uploadvideo',
				'title' => 'Путь до файла',
			),
		),
	));
	
	$t['file'] = $this->Azbn7->mdl('Entity')->createType(array(
		'fill' => 1,
		'parent' => $t['upload'],
		'uid' => 'file',
		'title' => 'Произвольный файл',
		'field' => array(
			'path' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'upload',
				'title' => 'Путь до файла',
			),
		),
	));
	*/
	
	/*
	$t['youtube'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => 0,//$t['video'],
		'uid' => 'youtube',
		'title' => 'Видео YouTube',
		'field' => array(
			'yt_uid' => array(
				'type' => "VARCHAR(256) DEFAULT ''",
				'editor' => 'input',
				'title' => 'UID ролика на YouTube',
			),
		),
		
	));
	
	$t['link'] = $this->Azbn7->mdl('Entity')->createType(array(
		'parent' => 0,
		'uid' => 'link',
		'title' => 'Ссылка',
		'field' => array(
			'path' => array(
				'type' => "TEXT DEFAULT ''",
				'editor' => 'input',
				'title' => 'Адрес',
			),
		),
	));
	*/
	
	/*
	$this->Azbn7->mdl('Site')
		->log('site.create_entity_types', array(
			
		))
	;
	*/
	
	$this->Azbn7->mdl('DB')->create('alias', array('pos' => 0, 'find' => 'установлено', 'set' => 'install/installed', 'title' => 'Страница информации после установки'));
	$this->Azbn7->mdl('DB')->create('alias', array('pos' => 0, 'find' => 'sitemap.xml', 'set' => '_/sitemap', 'title' => 'Файл sitemap.xml для поисковиков'));
	$this->Azbn7->mdl('DB')->create('alias', array('pos' => 0, 'find' => 'robots.txt', 'set' => '_/robots', 'title' => 'Файл robots.txt для поисковиков'));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_aliases', array(
			
		))
	;
	
	/*
	$this->Azbn7->mdl('DB')->create('user', array(
		'created_at' => $this->Azbn7->created_at,
		'login' => 'system',
		'email' => 'i@azbn.ru',
		'pass' => $this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->randstr(16), 'user', 'system'),
		'right' => $this->Azbn7->getJSON(array(
			
		)),
		'param' => $this->Azbn7->getJSON(array(
			'theme' => 'azbn-tpl/ru',
			'theme_admin' => 'azbn7-admin/ru',
			'lang' => 'ru',
			'wysiwyg' => 'textarea',
		)),
	));
	$this->Azbn7->mdl('DB')->create('user', array(
		'created_at' => $this->Azbn7->created_at,
		'login' => 'admin',
		'email' => 'i@azbn.ru',
		'pass' => $this->Azbn7->mdl('Session')->getPassHash('admin', 'user', 'admin'),
		'right' => $this->Azbn7->getJSON(array(
			'site.admin.login' => 1,
			'site.user.all.access' => 1,
			'site.user.item.right.access' => 1,
		)),
		'param' => $this->Azbn7->getJSON(array(
			'theme' => 'azbn-tpl/ru',
			'theme_admin' => 'azbn7-admin/ru',
			'lang' => 'ru',
			'wysiwyg' => 'ckeditor',
		)),
	));
	
	$this->Azbn7->mdl('Site')
		->log('site.create_users', array(
			
		))
	;
	*/
	
	$e = array();
	$b = array();
	
	$_SESSION['user']['id'] = 1;
	
	$presets = file_get_contents('./sites/config/presets.json');
	
	//die($presets);
	
	if($presets != '') {
		$_presets = $this->Azbn7->parseJSON($presets);
		
		//var_dump($presets);
		//die();
		
		if(count($_presets)) {
			
			
			$presets = $_presets['presets'];
			
			if(count($presets)) {
				if(isset($presets['default'])) {
					
					
					
					$p = $presets['default'];
					
					
					
					if(count($p['users'])) {
						
						foreach($p['users'] as $__user) {
							
							$this->Azbn7->mdl('DB')->create('user', array(
								'created_at' => $this->Azbn7->created_at,
								'login' => $__user['login'],
								'email' => $__user['email'],
								'pass' => $this->Azbn7->mdl('Session')->getPassHash($__user['pass'], 'user', $__user['login']),
								'right' => $this->Azbn7->getJSON($__user['right']),
								'param' => $this->Azbn7->getJSON($__user['param']),
							));
							
						}
						
					}
					
					
					
					if(count($p['types'])) {
						
						foreach($p['types'] as $__type) {
							
							$this->Azbn7->mdl('Entity')->createType($__type);
							
						}
						
					}
					
					
					
					if(count($p['entities'])) {
						
						foreach($p['entities'] as $__entity) {
							
							$this->Azbn7->mdl('Entity')->createEntity($__entity);
							
						}
						
					}
					
					
					
				}
			}
			
			
		}
		
	}
	
	/*
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 10,
			'parent' => 0,
			'pos' => 0,
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'mainpage',
			'param' => $this->Azbn7->getJSON(array()),
		),
		'item' => array(
			'title' => 'Главная страница',
			'preview' => 'Краткое описание',
			'content' => 'Полный текст',
			'param' => $this->Azbn7->getJSON(array()),
		),
	));
	
	
	$this->Azbn7->mdl('Site')
		->log('site.create_entity', array(
			'entity' => $e[0],
			'title' => 'Создание главной страницы',
		))
	;
	*/
	
	/*
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 10,
			'parent' => 0,
			'pos' => $default['max_bigint'],
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'помощь',
			'param' => $this->Azbn7->getJSON(array()),
		),
		'item' => array(
			'title' => 'Страница помощи',
			'preview' => 'Что делать после установки',
			'content' => '<p>Полный текст страницы помощи</p>',
			'param' => $this->Azbn7->getJSON(array()),
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
	*/
	
	unset($_SESSION['user']);
	
	
	$this->Azbn7->event(array(
		'action' => 'app.run.route.install.main.after',
		'title' => 'Установка основных таблиц базы данных MySQL',
	));
	
	$this->Azbn7->go2('/установлено/');
	
}