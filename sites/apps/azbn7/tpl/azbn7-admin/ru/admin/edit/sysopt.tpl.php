<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Редактирование параметра</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/sysopt/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[uid]',
		'value' => $param['item']['uid'],
		'input_html' => 'disabled',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Название (пояснение)',
		'html' => ' id="" ',
		'name' => 'item[data][title]',
		'value' => $param['item']['title'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/sysopt/json', array(
		'title' => 'Формат',
		'html' => ' id="" ',
		'name' => 'item[json]',
		'value' => $param['item']['json'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/sysopt/editable', array(
		'title' => 'Возможность редактирования',
		'html' => ' id="" ',
		'name' => 'item[editable]',
		'value' => $param['item']['editable'],
		//'path' => 'entity',
	));
	?>
	
	<?
	/*
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Редактировать через',
		'html' => ' id="" ',
		'input_html' => ' list="input-list-editors-0" ',
		'name' => 'item[editor]',
		'value' => $param['item']['editor'],
		//'path' => 'entity',
	));
	*/
	?>
	
	<div class="form-group " >
		<label>Редактировать через</label>
		<?
		$this->Azbn7->mdl('Viewer')->tpl('_/editor/select_editor', array(
			'name' => 'item[editor]',
			'value' => $param['item']['editor'],
			//'path' => 'entity',
		));
		?>
	</div>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/' . $param['item']['editor'], array(
		'title' => 'Значение параметра',
		'html' => ' id="" ',
		'name' => 'item[value]',
		'value' => $param['item']['value'],
		//'path' => 'entity',
	));
	?>
	
	<!--
	<div class="form-check">
		<label class="form-check-label">
			<input type="checkbox" class="form-check-input">
			Check me out
		</label>
	</div>
	-->
	
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