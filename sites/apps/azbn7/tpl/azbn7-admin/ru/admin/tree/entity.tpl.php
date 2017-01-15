<?
// Административный шаблон

$user_arr = array();

$users = $this->Azbn7->mdl('DB')->read('user');
if(count($users)) {
	foreach($users as $u) {
		$user_arr[$u['id']] = $u;
	}
}

?>

<h2 class="mt-2 mb-1" >
	<?=$param['type']['title'];?>. Записи. В виде дерева
	
	<div class="float-xs-right item-base-functions" >
		
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $param['type']['id']);?>" title="В виде списка" ><i class="fa fa-list" aria-hidden="true"></i></a>
		
		<?
		if($param['type']['fill']) {
		?>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $param['type']['id']);?>" title="Создать запись" ><i class="fa fa-plus-circle" aria-hidden="true" ></i></a>
		<?
		}
		?>
		
	</div>
	
</h2>

<div class="row azbn-flt-block mt-3 mb-3" >
	<div class="col-xs-12" >
		
		<form>
			
			<input type="hidden" name="type" value="<?=$param['type']['id'];?>" />
			
			<div class="row " >
				
				<div class="col-md-6" >
					<div class="form-group">
						
						<div class="row " >
							<div class="col-xs-12 col-sm-6" >
								<label >Дата создания между</label>
								<input type="text" class="form-control datepicker " name="flt[created_at][start]" value="<?=$this->Azbn7->c_s($_GET['flt']['created_at']['start']);?>" placeholder="Начало" />
							</div>
							
							<div class="col-xs-12 col-sm-6" >
								<label >&nbsp;</label>
								<input type="text" class="form-control datepicker " name="flt[created_at][stop]" value="<?=$this->Azbn7->c_s($_GET['flt']['created_at']['stop']);?>" placeholder="Окончание" />
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="col-md-6" >
					<div class="form-group">
						
						<div class="row " >
							<div class="col-xs-12 col-sm-6" >
								<label >Дата изменения между</label>
								<input type="text" class="form-control datepicker " name="flt[updated_at][start]" value="<?=$this->Azbn7->c_s($_GET['flt']['updated_at']['start']);?>" placeholder="Начало" />
							</div>
							
							<div class="col-xs-12 col-sm-6" >
								<label >&nbsp;</label>
								<input type="text" class="form-control datepicker " name="flt[updated_at][stop]" value="<?=$this->Azbn7->c_s($_GET['flt']['updated_at']['stop']);?>" placeholder="Окончание" />
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="col-md-6" >
					<div class="form-group">
						<label >Автор записи</label>
						<select class="form-control " name="flt[user]" >
							<option value="0" >Любой</option>
							<?
							$users = $this->Azbn7->mdl('DB')->read('user');
							if(count($users)) {
								foreach($users as $u) {
							?>
							<option value="<?=$u['id'];?>" <? if($this->Azbn7->as_num($_GET['flt']['user']) == $u['id']) { echo 'selected';} ?> ><?=$u['login'];?></option>
							<?
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="col-md-3" >
					<div class="form-group">
						<label >Отображение</label>
						<select class="form-control " name="flt[visible]" >
							<option value="" <? if($_GET['flt']['visible'] == '') { echo 'selected';} ?> >Любой статус</option>
							<option value="0" <? if($this->Azbn7->as_num($_GET['flt']['visible']) == 0) { echo 'selected';} ?> >Не отображается</option>
							<option value="5" <? if($this->Azbn7->as_num($_GET['flt']['visible']) == 5) { echo 'selected';} ?> >Частично</option>
							<option value="10" <? if($this->Azbn7->as_num($_GET['flt']['visible']) == 10) { echo 'selected';} ?> >Полностью</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-3" >
					<div class="form-group">
						<label >&nbsp;</label>
						<input type="submit" class="btn btn-block btn-info" value="Отфильтровать" />
					</div>
				</div>
				
			</div>
			
		</form>
		
	</div>
</div>

<?

if(count($param['items'])) {
	
	$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($param['items']);
	
	$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/list_entity', array(
		'html' => 'class="list-entity-type " id="" ',
		'hierarchy' => $entity_type_h,
		'start_index' => 0,
		'hide_zero' => 1,
	));
	
}

?>