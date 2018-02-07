<?

$default = array(
	'max_int' => $this->Azbn7->config['mysql'][0]['max_value']['int'],
	'max_bigint' => $this->Azbn7->config['mysql'][0]['max_value']['bigint'],
);

$this->Azbn7->mdl('Session')->logout('user');
$this->Azbn7->mdl('Session')->logout('profile');

if(count($this->Azbn7->mdl('DB')->t)) {
	
	
	/* ---------- ext__event ---------- */
	$this->Azbn7
		->mdl('Ext')
			->event($this->event_prefix . '.app.run.route.install.main.before')
	;
	/* --------- /ext__event ---------- */
	
	
	$this->Azbn7->mdl('DB')
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['sysopt'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`json` ENUM('0', '1') DEFAULT '0',
				`editable` ENUM('0', '1') DEFAULT '0',
				`uid` VARCHAR(255) NOT NULL UNIQUE,
				`editor` VARCHAR(255) DEFAULT 'input',
				`value` MEDIUMBLOB DEFAULT NULL,
				INDEX uid_index (uid(64))
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['sysopt_data'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`uid` VARCHAR(255) NOT NULL UNIQUE,
				`title` VARCHAR(255) DEFAULT '',
				INDEX uid_index (uid(64))
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['state'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`parent` BIGINT DEFAULT '0',
				`uid` VARCHAR(255) NOT NULL UNIQUE,
				`title` VARCHAR(255) DEFAULT '',
				INDEX uid_index (uid(64))
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['alias'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`pos` BIGINT DEFAULT '{$default['max_bigint']}',
				`visible` ENUM('0', '10') DEFAULT '10',
				`find` VARCHAR(255) DEFAULT '',
				`set` VARCHAR(255) DEFAULT '',
				`title` VARCHAR(255) DEFAULT ''
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['right'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`uid` VARCHAR(255) NOT NULL UNIQUE,
				`title` VARCHAR(255) DEFAULT ''
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_type'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`fill` ENUM('0', '1') DEFAULT '1',
				`parent` BIGINT DEFAULT '0',
				`uid` VARCHAR(255) NOT NULL UNIQUE,
				`title` VARCHAR(255) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT NULL
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
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
				`url` TEXT DEFAULT NULL,
				`param` MEDIUMBLOB DEFAULT NULL,
				INDEX url_index (url(64)),
				FOREIGN KEY (type) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity_type'] . "(id)
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_seo'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`entity` BIGINT DEFAULT '0',
				`title` VARCHAR(255) DEFAULT '',
				`description` VARCHAR(255) DEFAULT '',
				`keywords` VARCHAR(255) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT NULL,
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_state'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`entity` BIGINT DEFAULT '0',
				`state` BIGINT DEFAULT '0',
				`created_at` BIGINT DEFAULT '0',
				`deleted_at` BIGINT DEFAULT '0',
				`param` MEDIUMBLOB DEFAULT NULL,
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['log'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`created_at` BIGINT DEFAULT '0',
				`user` BIGINT DEFAULT '0',
				`profile` BIGINT DEFAULT '0',
				`entity` BIGINT DEFAULT '0',
				`uid` VARCHAR(255) DEFAULT '',
				`param` MEDIUMBLOB DEFAULT NULL,
				INDEX uid_index (uid(64)),
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id)
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['role'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`title` VARCHAR(255) DEFAULT '',
				`right` MEDIUMBLOB DEFAULT NULL,
				`param` MEDIUMBLOB DEFAULT NULL
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['user'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`status` TINYINT DEFAULT '1',
				`created_at` BIGINT DEFAULT '0',
				`pass` VARCHAR(64) DEFAULT '',
				`key` VARCHAR(64) DEFAULT '',
				`email` VARCHAR(255) DEFAULT '',
				`login` VARCHAR(255) NOT NULL UNIQUE,
				`view_as` VARCHAR(255) NOT NULL,
				`right` MEDIUMBLOB DEFAULT NULL,
				`param` MEDIUMBLOB DEFAULT NULL
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['profile'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`status` TINYINT DEFAULT '1',
				`created_at` BIGINT DEFAULT '0',
				`pass` VARCHAR(64) DEFAULT '',
				`key` VARCHAR(64) DEFAULT '',
				`email` VARCHAR(255) DEFAULT '',
				`login` VARCHAR(255) NOT NULL UNIQUE,
				`view_as` VARCHAR(255) NOT NULL,
				`right` MEDIUMBLOB DEFAULT NULL,
				`param` MEDIUMBLOB DEFAULT NULL
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['role_bound'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`role` BIGINT DEFAULT '0',
				`item` BIGINT DEFAULT '0',
				`type` VARCHAR(255) DEFAULT 'profile',
				FOREIGN KEY (role) REFERENCES " . $this->Azbn7->mdl('DB')->t['role'] . "(id) ON DELETE CASCADE
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_bound'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`parent` BIGINT DEFAULT '0',
				`child` BIGINT DEFAULT '0',
				INDEX parent_index (`parent`),
				INDEX child_index (`child`),
				FOREIGN KEY (parent) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_data'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`json` ENUM('0', '1') DEFAULT '0',
				`entity` BIGINT DEFAULT '0',
				`uid` VARCHAR(255) DEFAULT '',
				`value` MEDIUMBLOB DEFAULT NULL,
				INDEX main_index (entity, uid(64)),
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
		->exec("CREATE TABLE IF NOT EXISTS `" . $this->Azbn7->mdl('DB')->t['entity_search'] . "` (
				`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`entity` BIGINT DEFAULT '0',
				`created_at` BIGINT DEFAULT '0',
				`updated_at` BIGINT DEFAULT '0',
				`content` LONGTEXT DEFAULT NULL,
				INDEX by_entity (`entity`),
				FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE,
				FULLTEXT KEY `content_search` (`content`)
			) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
		")
		
	;
	
	$this->Azbn7->mdl('Site')
		->log('site.db.create_tables', array(
			
		))
	;
	
	//$this->Azbn7->mdl('DB')->create('state', array('uid' => 'default', 'title' => 'Стандартное состояние записи'));
	$this->Azbn7->mdl('DB')->create('state', array('uid' => 'test', 'title' => 'Состояние тестирования'));
	
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
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.state.all.access', 'title' => 'Доступ к состояниям'));
	$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.alias.all.access', 'title' => 'Доступ к синонимам'));
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
	
	$e = array();
	$b = array();
	
	$_SESSION['user']['id'] = 1;
	
	$presets = file_get_contents('./sites/config/presets.json');
	
	if($presets != '') {
		$_presets = $this->Azbn7->parseJSON($presets);
		
		if(count($_presets)) {
			
			
			$presets = $_presets['presets'];
			
			if(count($presets)) {
				//if(isset($presets['default'])) {
				foreach($presets as $p) {
					
					
					//$p = $presets['default'];
					
					
					if(count($p['aliases'])) {
						
						foreach($p['aliases'] as $__alias) {
							
							$this->Azbn7->mdl('DB')->create('alias', $__alias);
							
						}
						
					}
					
					
					if(count($p['users'])) {
						
						foreach($p['users'] as $__user) {
							
							$this->Azbn7->mdl('DB')->create('user', array(
								'created_at' => $this->Azbn7->created_at,
								'login' => $__user['login'],
								'email' => $__user['email'],
								'pass' => $this->Azbn7->mdl('Session')->getPassHash($__user['pass'], 'user', $__user['login']),
								'key' => $this->Azbn7->created_at . mb_strtoupper($this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->randstr(32), 'api', $__user['login']), $this->Azbn7->config['charset']),
								'right' => $this->Azbn7->getJSON($__user['right']),
								'param' => $this->Azbn7->getJSON($__user['param']),
							));
							
						}
						
					}
					
					
					if(count($p['profiles'])) {
						
						foreach($p['profiles'] as $__user) {
							
							$this->Azbn7->mdl('DB')->create('profile', array(
								'created_at' => $this->Azbn7->created_at,
								'login' => $__user['login'],
								'email' => $__user['email'],
								'pass' => $this->Azbn7->mdl('Session')->getPassHash($__user['pass'], 'profile', $__user['login']),
								'key' => $this->Azbn7->created_at . mb_strtoupper($this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->randstr(32), 'api', $__user['login']), $this->Azbn7->config['charset']),
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
							
							if(file_exists($__entity['item']['content'])) {
								
								$__entity['item']['content'] = file_get_contents($__entity['item']['content']);
								
							}
							
							$this->Azbn7->mdl('Entity')->createEntity($__entity);
							
						}
						
					}
					
					
					
				}
			}
			
			
		}
		
	}
	
	unset($_SESSION['user']);
	
	
	$this->Azbn7->event(array(
		'action' => $this->event_prefix . '.app.run.route.install.main.after',
		'title' => 'Установка основных таблиц базы данных MySQL',
	));
	
	
	/* ---------- ext__event ---------- */
	$this->Azbn7
		->mdl('Ext')
			->event($this->event_prefix . '.app.run.route.install.main.after')
	;
	/* --------- /ext__event ---------- */
	
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/установлено/'));
	
}