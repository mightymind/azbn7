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

$this->Azbn7->mdl('Site')
	->render('entity/by_type/page', $param)
;
