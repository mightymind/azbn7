<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" ><?=$param['type']['title'];?>. Редактирование записи</h2>

<hr />

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/entity/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'entity[id]',
		'value' => $param['entity']['id'],
		//'path' => 'entity',
	));
	?>
	
	<div class="row" >
		<div class="col-sm-6" >
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/visible', array(
				'title' => 'Отображать на сайте',
				'html' => ' id="" ',
				'name' => 'entity[visible]',
				'value' => $param['entity']['visible'],
				//'path' => 'entity',
			));
			?>
			
			<hr />
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
				'title' => 'Адрес URL на сайте (без начального и конечного /)',
				'html' => ' id="" ',
				'name' => 'entity[url]',
				'value' => $param['entity']['url'],
				//'path' => 'entity',
			));
			?>
		</div>
		<div class="col-sm-6" >
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/entity-select', array(
				'title' => 'Родительская запись',
				'html' => ' id="" ',
				'name' => 'entity[parent]',
				'value' => $param['entity']['parent'],
				'type' => '0',
				//'single' => 1,
				//'path' => 'entity',
			));
			?>
		</div>
	</div>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/pos', array(
		'title' => 'Позиция элемента в общем списке',
		'html' => ' id="" ',
		'name' => 'entity[pos]',
		'value' => $param['entity']['pos'],
		//'path' => 'entity',
	));
	?>
	
	
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Заголовок',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => $param['item']['title'],
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
				'value' => $param['item'][$k],
				'path' => 'entity',
			));
		}
	}
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/submit', array(
		'title' => 'Обновить',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>