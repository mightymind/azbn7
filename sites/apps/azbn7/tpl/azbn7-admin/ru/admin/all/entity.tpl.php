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
	<?=$param['type']['title'];?>. Записи
	
	<div class="float-sm-right item-base-functions" >
		
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/tree/entity/?type=' . $param['type']['id']);?>" title="В виде дерева" ><i class="fa fa-sitemap" aria-hidden="true"></i></a>
		
		<a class="azbn-flt-block-btn" href="#" title="Фильтр записей" data-flt-block=".azbn-flt-block" ><i class="fa fa-filter" aria-hidden="true"></i></a>
		
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
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/mass-select', $param);
	?>
	
	<hr />
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th class="at-center" ><input type="checkbox" class="azbn-entity-all-cbs-cb" value="" /></th>
				<th class="at-center" >ID</th>
				<th class="at-center" >Поз.</th>
				<th class="at-center" >Отобр.</th>
				<th>Название</th>
				<th class="at-center" >Автор</th>
				<th class="at-center" >Дата изм. / созд.</th>
				<th class="at-center" >Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($param['items'] as $v) {
		
		$item = $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('DB')->prefix . '_' . $param['type']['uid'], "entity = '{$v['id']}'");
		
		?>
			
			<tr>
				<th class="at-center" scope="row">
					<input type="checkbox" class="azbn-entity-all-mass-cb" value="<?=$v['id'];?>" />
				</th>
				<th class="at-center" scope="row"><?=$v['id'];?></th>
				<th class="at-center" scope="row"><?=$v['pos'];?></th>
				<td class="at-center" >
					<?
					switch($v['visible']) {
						
						case 0:{
							
						}
						break;
						
						case 5:{
							echo '<i class="fa fa-eye-slash" aria-hidden="true" title="Частично отображается" ></i>';
						}
						break;
						
						case 10:{
							echo '<i class="fa fa-eye" aria-hidden="true" title="Отображается на сайте" ></i>';
						}
						break;
						
						default:{
							
						}
						break;
						
					}
					?>
				</td>
				<td>
					<?=$item['title'];?>
					<br />
					<?
					if($v['url'] != '') {
					?>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?>" target="_blank" ><?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?></a>
					<?
					} else {
					?>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/');?>" target="_blank" ><?=$this->Azbn7->mdl('Site')->url('/');?></a>
					<?
					}
					?>
				</td>
				<td class="at-center" ><?=$user_arr[$v['user']]['login'];?></td>
				<td class="at-center" >
					<strong><?=date('d.m.Y H:i', $v['updated_at']);?></strong>
					<br />
					<?=date('d.m.Y H:i', $v['created_at']);?>
				</td>
				<td class="at-center item-edit-functions" >
					
					<a href="<?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?>" target="_blank" title="Открыть на сайте" ><i class="fa fa-link" aria-hidden="true"></i></a>
					
					<?
					//if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
					if($v['locked_by'] > 0) {
						
						if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
						?>
						<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/lock/entity/' . $v['id'] . '/?action=unlock');?>" title="Разблокировать запись" ><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
						<?
						}
						
					} else {
						
						if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
						?>
						<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/lock/entity/' . $v['id'] . '/?action=lock');?>" title="Заблокировать запись от изменений" ><i class="fa fa-lock" aria-hidden="true"></i></a>
						<?
						}
						
						if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity_seo.access')) {
						?>
						<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity_seo/' . $v['id'] . '/');?>" title="SEO-настройки и продвижение" ><i class="fa fa-google" aria-hidden="true"></i></a>
						<?
						}
						
						if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.not_author.update') || $this->Azbn7->mdl('Site')->is('user') == $v['user']) {
						?>
						<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $v['id'] . '/');?>" title="Редактировать" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
						<?
						}
						
						if($param['type']['fill'] && $this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.copy')) {
						?>
						<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/copy/entity/' . $v['id'] . '/');?>" title="Скопировать запись" ><i class="fa fa-files-o" aria-hidden="true"></i></a>
						<?
						}
						
						if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.not_author.delete') || $this->Azbn7->mdl('Site')->is('user') == $v['user']) {
						?>
						<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/delete/entity/' . $v['id'] . '/');?>" class="delete-confirm " title="Удалить" ><i class="fa fa-times" aria-hidden="true" ></i></a>
						<?
						}
						
					}
					?>
					
				</td>
			</tr>
			
		<?
	}
	?>
		</tbody>
	</table>
	
	<hr />
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/mass-select', $param);
	?>
	
	<?
	
}

$this->Azbn7->mdl('Viewer')->tpl('_/pagination', $param);

?>