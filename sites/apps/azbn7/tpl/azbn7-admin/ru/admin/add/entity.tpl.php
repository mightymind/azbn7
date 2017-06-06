<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" ><?=$param['type']['title'];?>. Создание записи</h2>

<hr />

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/entity/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'type[id]',
		'value' => $param['type']['id'],
		//'path' => 'entity',
	));
	?>
	
	<div class="row" >
		<div class="col-sm-7" >
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
				'title' => 'Заголовок',
				'html' => ' id="" ',
				'name' => 'item[title]',
				'value' => '',
				'input_html' => ' data-need-upload-param="title" ',
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
				'title' => 'Адрес URL на сайте (без начального и конечного /)',
				'html' => ' id="" ',
				'name' => 'entity[url]',
				'value' => $param['type']['uid'] . '/' . date('Ymd') . '/' . $this->Azbn7->randstr(32),//$param['type']['uid'] . '/' . $this->Azbn7->randstr(32),
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
				'title' => 'Перенаправить на URL (без начального и конечного /)',
				'html' => ' id="" ',
				'name' => 'route[redirect]',
				'value' => '',
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
				'title' => 'Код обработчик (без .run.php)',
				'html' => ' id="" ',
				'name' => 'route[run][path]',
				'value' => $param['type']['uid'],
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
		</div>
		<div class="col-sm-5" >
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity/visible', array(
				'title' => 'Отображать на сайте',
				'html' => ' id="" ',
				'name' => 'entity[visible]',
				'value' => '10',
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/pos', array(
				'title' => 'Позиция элемента в общем списке',
				'html' => ' id="" ',
				'name' => 'entity[pos]',
				'value' => $this->Azbn7->config['mysql'][0]['max_value']['js_int'],
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity-autocomplete-single', array(
				'title' => 'Родительская запись',
				'html' => ' id="" ',
				'name' => 'entity[parent]',
				'value' => '0',
				'type' => '0',
				'single' => 1,
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity-autocomplete', array(
				'title' => 'Относится к следующим записям',
				'html' => ' id="" ',
				'name' => 'bound_as-child',
				'value' => '[]',
				'type' => '0',
				'single' => 0,
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity-autocomplete', array(
				'title' => 'Относятся к этой записи',
				'html' => ' id="" ',
				'name' => 'bound_as-parent',
				'value' => '[]',
				'type' => '0',
				'single' => 0,
				//'path' => 'entity',
			));
			?>
			
		</div>
	</div>
	
	<?
	//var_dump($param['type']);
	if(count($param['type']['param']['field'])) {
		foreach($param['type']['param']['field'] as $k => $v) {
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/' . $v['editor'], array(
				'title' => $v['title'],
				'html' => ' id="" ',
				'name' => 'item[' . $k . ']',
				'value' => '',
				'path' => 'entity',
			));
		}
	}
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/submit', array(
		'title' => 'Создать',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>