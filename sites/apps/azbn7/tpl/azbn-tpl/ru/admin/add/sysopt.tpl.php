<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Создание параметра</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/sysopt/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[uid]',
		'value' => 'site.some.sysopt',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Название (пояснение)',
		'html' => ' id="" ',
		'name' => 'item[data][title]',
		'value' => 'Произвольный параметр',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/sysopt/json', array(
		'title' => 'Формат',
		'html' => ' id="" ',
		'name' => 'item[json]',
		'value' => '0',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/sysopt/editable', array(
		'title' => 'Возможность редактирования',
		'html' => ' id="" ',
		'name' => 'item[editable]',
		'value' => '0',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/textarea', array(
		'title' => 'Значение параметра',
		'html' => ' id="" ',
		'name' => 'item[value]',
		'value' => '',
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
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/submit', array(
		'title' => 'Создать',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>