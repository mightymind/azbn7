<?

$default = array(
	'max_int' => $this->Azbn7->config['mysql'][0]['max_value']['int'],
	'max_bigint' => $this->Azbn7->config['mysql'][0]['max_value']['bigint'],
);

$this->Azbn7->mdl('Session')->logout('user');
$this->Azbn7->mdl('Session')->logout('profile');

if(count($this->Azbn7->mdl('DB')->t)) {
	
	$e = array(1);
	$b = array();
	
	$_SESSION['user']['id'] = 1;
	
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 1,
			'parent' => 0,
			'pos' => 6546516,
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'contact',
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'title' => 'Контакты',
			'preview' => 'Страница контактов организации',
			'content' => file_get_contents('tmp/fish/contact.html'),
			'param' => $this->Azbn7->arr2json(array()),
		),
	));
	
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 1,
			'parent' => 0,
			'pos' => 1325416,
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'service',
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'title' => 'Услуги',
			'preview' => 'Страница про услуги организации',
			'content' => file_get_contents('tmp/fish/service.html'),
			'param' => $this->Azbn7->arr2json(array()),
		),
	));
	
	$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
		'type' => 'page',
		'entity' => array(
			'visible' => 1,
			'parent' => 0,
			'pos' => 4535687,
			//'uid' => $this->Azbn7->randstr(32),
			'url' => 'about',
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'title' => 'О нас',
			'preview' => 'О нас',
			'content' => file_get_contents('tmp/fish/about.html'),
			'param' => $this->Azbn7->arr2json(array()),
		),
	));
	
	/*
	for($i = 0; $i < 1000000; $i++) {
		
		$e[] = $this->Azbn7->mdl('Entity')->createEntity(array(
			'type' => 'page',
			'entity' => array(
				'visible' => 1,
				'parent' => 1,
				'pos' => $i,
				//'uid' => $this->Azbn7->randstr(32),
				'url' => $this->Azbn7->randstr(32),
				'param' => $this->Azbn7->arr2json(array()),
			),
			'item' => array(
				'title' => 'Страница ' . $this->Azbn7->randstr(32),
				'preview' => $this->Azbn7->randstr(16) . ' ' . $this->Azbn7->randstr(16) . ' ' . $this->Azbn7->randstr(16) . ' ' . $this->Azbn7->randstr(16),
				'content' => '',
				'param' => $this->Azbn7->arr2json(array()),
			),
		));
		
		//sleep(0.256);
		
	}
	*/
	
	$this->Azbn7->event(array(
		'action' => 'app.run.route.install.fish.after',
		'title' => 'Наполнение "рыбой"',
	));
	
	unset($_SESSION['user']);
	
	$this->Azbn7->go2('/установлено/');
	
}