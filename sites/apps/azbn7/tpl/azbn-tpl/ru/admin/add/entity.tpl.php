<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" ><?=$param['type']['title'];?>. Создание записи</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/entity/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'type[id]',
		'value' => $param['type']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/visible', array(
		'title' => 'Отображать на сайте',
		'html' => ' id="" ',
		'name' => 'entity[visible]',
		'value' => '1',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/entity/parent', array(
		'title' => 'Родительская запись',
		'html' => ' id="" ',
		'name' => 'entity[parent]',
		'value' => '0',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/pos', array(
		'title' => 'Позиция элемента в общем списке',
		'html' => ' id="" ',
		'name' => 'entity[pos]',
		'value' => $this->Azbn7->config['mysql'][0]['max_value']['js_int'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Адрес URL на сайте (без начального и конечного /)',
		'html' => ' id="" ',
		'name' => 'entity[url]',
		'value' => $this->Azbn7->randstr(16),
		//'path' => 'entity',
	));
	?>
	
	
	<?
	//var_dump($param['type']);
	if(count($param['type']['param']['field'])) {
		foreach($param['type']['param']['field'] as $k => $v) {
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/' . $v['editor'], array(
				'title' => $v['title'],
				'html' => ' id="" ',
				'name' => 'item[' . $k . ']',
				'value' => '',
				'path' => 'entity',
			));
		}
	}
	?>
	
	
	<button type="submit" class="btn btn-primary">Создать</button>
	
</form>