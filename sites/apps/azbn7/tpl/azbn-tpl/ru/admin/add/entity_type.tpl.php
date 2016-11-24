<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<h2 class="mt-2 mb-1" >Создание типа данных</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/entity_type/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Название (пояснение)',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Уникальный ID',
		'html' => ' id="" ',
		'name' => 'item[uid]',
		'value' => $this->Azbn7->randstr(16),
		//'path' => 'entity',
	));
	?>
	
	<?
	$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
	$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

	$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/select', array(
		'title' => 'Родительский тип',
		'html' => ' id="" ',
		'name' => 'item[parent]',
		'value' => $this->Azbn7->randstr(16),
		'hierarchy' => $entity_type_h,
		'start_index' => 0,
	));
	?>
	
	<div class="field-list" >
		
		<hr />
		
		<label>Поля данных для записей</label>
		
		<div class="row field-item mb-2" >
			
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
				<input type="text" class="form-control" name="item[param][field][0][uid]" value="" placeholder="Название поля" />
			</div>
			
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
				<input type="text" class="form-control" list="input-list-types-0" name="item[param][field][0][type]" value="" placeholder="Тип поля (MySQL)" />
				<datalist id="input-list-types-0">
					<option value="BIGINT DEFAULT '0'">
					<option value="INT DEFAULT '0'">
					<option value="FLOAT DEFAULT '0'">
					<option value="VARCHAR(256) DEFAULT ''">
					<option value="TEXT DEFAULT ''">
					<option value="MEDIUMTEXT DEFAULT ''">
					<option value="BLOB DEFAULT ''">
					<option value="MEDIUMBLOB DEFAULT ''">
				</datalist>
			</div>
			
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
				<input type="text" class="form-control" list="input-list-editors-0" name="item[param][field][0][editor]" value="" placeholder="Редактировать через" />
				<datalist id="input-list-editors-0">
					<option value="email">
					<option value="hidden">
					<option value="input">
					<option value="pass">
					<option value="pos">
					<option value="textarea">
					<option value="upload">
					<option value="uploadimg">
					<option value="visible">
					<option value="wysiwyg">
				</datalist>
			</div>
			
		</div>
		
		<div class="row btn-panel" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				<input type="button" class="btn btn-success btn-add-item" value="+" />
			</div>
		</div>
		
		<hr />
		
	</div>
	
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