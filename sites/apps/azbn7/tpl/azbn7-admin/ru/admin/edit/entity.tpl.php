<?
// Административный шаблон

$param['route'] = $this->Azbn7->mdl('Entity')->getRoute($param);

?>

<h2 class="mt-2 mb-1" >
	<?=$param['type']['title'];?>. Редактирование записи
	
	<div class="float-sm-right item-base-functions" >
		
		<?
		/*
		if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
			if($param['entity']['locked_by']) {
				
			} else {
			?>
			<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/lock/entity/' . $param['entity']['id'] . '/?action=lock');?>" title="Заблокировать запись от изменений" ><i class="fa fa-lock" aria-hidden="true"></i></a>
			<?
			}
		}
		*/
		?>
		
		<?
		if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.type.' . $param['type']['uid'] . '.access') && $param['type']['fill']) {
		?>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $param['type']['id']);?>" title="Все записи данного типа" ><i class="fa fa-list-ul" aria-hidden="true"></i></a>
		<?
		}
		?>
		
		<?
		if($param['type']['fill']) {
		?>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $param['type']['id']);?>" title="Создать другую запись" ><i class="fa fa-plus-circle" aria-hidden="true" ></i></a>
		<?
		}
		?>
		
		<?
		if($param['type']['fill'] && $this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.copy')) {
		?>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/copy/entity/' . $param['entity']['id'] . '/');?>" title="Скопировать запись" ><i class="fa fa-files-o" aria-hidden="true"></i></a>
		<?
		}
		?>
		
		<?
		if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity_seo.access')) {
		?>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity_seo/' . $param['entity']['id'] . '/');?>" title="SEO-настройки и продвижение" ><i class="fa fa-google" aria-hidden="true"></i></a>
		<?
		}
		?>
		
		<a href="<?=$this->Azbn7->mdl('Site')->url('/' . $param['entity']['url'] . '/');?>" target="_blank" title="Открыть запись на сайте" ><i class="fa fa-link" aria-hidden="true"></i></a>
		
	</div>
	
</h2>

<hr />

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/entity/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'entity[id]',
		'value' => $param['entity']['id'],
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
				'value' => $param['item']['title'],
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
				'value' => $param['entity']['url'],
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
				'title' => 'Перенаправить на URL (без начального и конечного /)',
				'html' => ' id="" ',
				'name' => 'route[redirect]',
				'value' => $param['route']['redirect'],
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
				'title' => 'Код обработчик (без .run.php)',
				'html' => ' id="" ',
				'name' => 'route[run][path]',
				'value' => $param['route']['run']['path'],
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
				'value' => $param['entity']['visible'],
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/pos', array(
				'title' => 'Позиция элемента в общем списке',
				'html' => ' id="" ',
				'name' => 'entity[pos]',
				'value' => $param['entity']['pos'],
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity-autocomplete-single', array(
				'title' => 'Родительская запись',
				'html' => ' id="" ',
				'name' => 'entity[parent]',
				'value' => $param['entity']['parent'],
				'type' => '0',
				'single' => 1,
				//'path' => 'entity',
			));
			?>
			
			
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			
			$bounds = $this->Azbn7->mdl('Entity')->getBounds(null, $param['entity']['id']);
			
			$bound_arr = array();
			
			if(count($bounds)) {
				foreach($bounds as $b) {
					$bound_arr[] = $b['parent'];
				}
			}
			
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity-autocomplete', array(
				'title' => 'Относится к следующим записям',
				'html' => ' id="" ',
				'name' => 'bound_as-child',
				'value' => $this->Azbn7->getJSON($bound_arr),
				'type' => '0',
				'single' => 0,
				//'path' => 'entity',
			));
			?>
			
			<div class="spacer" data-space="20" ></div>
			
			<?
			
			$bounds = $this->Azbn7->mdl('Entity')->getBounds($param['entity']['id'], null);
			
			$bound_arr = array();
			
			if(count($bounds)) {
				foreach($bounds as $b) {
					$bound_arr[] = $b['child'];
				}
			}
			
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/entity-autocomplete', array(
				'title' => 'Относятся к этой записи',
				'html' => ' id="" ',
				'name' => 'bound_as-parent',
				'value' => $this->Azbn7->getJSON($bound_arr),
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
				'value' => $param['item'][$k],
				'path' => 'entity',
			));
		}
	}
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/submit', array(
		'title' => 'Обновить',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>