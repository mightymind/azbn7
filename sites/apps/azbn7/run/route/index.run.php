<?

/*
$this->Azbn7->mdl('Ext')->ext('azbn7.ext.cron')->setTask(array(
	'uid' => 'test1',
	'is_single' => 1,
	'lastact' => 0,
	'period' => 0,
	'run' => array(
		'dir' => 'app',
		'path' => 'cron/test',
	)
));

$this->Azbn7->mdl('Ext')->ext('azbn7.ext.cron')->setTask(array(
	'uid' => 'test2',
	'is_single' => 0,
	'lastact' => 0,
	'period' => 60,
	'run' => array(
		'dir' => 'app',
		'path' => 'cron/test',
	)
));
*/

$param['entity'] = $this->Azbn7->mdl('Entity')->item(1);

//$this->Azbn7->mdl('Entity')->createState($param['entity']['entity']['id'], 'default');
//$this->Azbn7->mdl('Entity')->createState($param['entity']['entity']['id'], 'test');

//$this->Azbn7->mdl('Viewer')->echo_dev($this->Azbn7->mdl('Entity')->getSTates($param['entity']['entity']['id']), true);

//$this->Azbn7->mdl('Entity')->createState($param['entity']['entity']['id'], 'default');
//$this->Azbn7->mdl('Entity')->deleteState($param['entity']['entity']['id'], 'default');

//$this->Azbn7->mdl('Viewer')->echo_dev($this->Azbn7->mdl('Entity')->inState($param['entity']['entity']['id'], 'default'), true);
//$this->Azbn7->mdl('Viewer')->echo_dev($this->Azbn7->mdl('Entity')->inState($param['entity']['entity']['id'], 'test'), true);

$this->Azbn7->mdl('Site')
	->render('entity/by_type/page', $param)
;
