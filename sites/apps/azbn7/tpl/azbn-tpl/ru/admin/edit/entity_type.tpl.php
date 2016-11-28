<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<h2 class="mt-2 mb-1" >Редактирование типа данных</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/entity_type/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Название (пояснение)',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => $param['item']['title'],
		//'path' => 'entity',
	));
	?>
	
	<?
	//var_dump($param['type']);
	if(count($param['item']['param']['field'])) {
		foreach($param['item']['param']['field'] as $k => $v) {
			
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
				'title' => 'Редактор поля ' . $v['title'],
				'html' => ' id="" ',
				'name' => 'param[field][' . $k . '][editor]',
				'value' => $v['editor'],
				//'path' => 'entity',
			));
			
		}
	}
	?>
	
	<div class="field-list" >
		
		<hr />
		
		<label>Добавить поля</label>
		
		<div class="row field-item mb-2" >
			
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" >
				<input type="text" class="form-control" name="item[param][field][0][title]" value="" placeholder="Название поля" />
			</div>
			
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" >
				<input type="text" class="form-control" name="item[param][field][0][uid]" value="" placeholder="UID поля" />
			</div>
			
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" >
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
			
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" >
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
		'title' => 'Обновить',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>