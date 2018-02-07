<?
// Административный шаблон
?>



<h2 class="mt-2 mb-1" >
	Логи сайта
	
	<div class="float-sm-right item-base-functions" >
		<a class="azbn-flt-block-btn" href="#" title="Фильтр логов" data-flt-block=".azbn-flt-block" ><i class="fa fa-filter" aria-hidden="true"></i></a>
	</div>
	
</h2>

<div class="row azbn-flt-block mt-3 mb-3" >
	<div class="col-xs-12" >
		
		<form>
			
			<div class="row " >
				
				<div class="col-xs-2" >
					<div class="form-group">
						<label >Администратор</label>
						<select class="form-control " name="flt[user]" >
							<option value="0" >Любой</option>
							<?
							$users = $this->Azbn7->mdl('DB')->read('user');
							if(count($users)) {
								foreach($users as $u) {
							?>
							<option value="<?=$u['id'];?>" <? if(isset($_GET['flt']['user'])) {if($this->Azbn7->c_s($_GET['flt']['user']) == $u['id']) { echo 'selected';}} ?> ><?=$u['login'];?></option>
							<?
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="col-xs-2" >
					<div class="form-group">
						<label >Профиль</label>
						<select class="form-control " name="flt[profile]" >
							<option value="0" >Любой</option>
							<?
							$users = $this->Azbn7->mdl('DB')->read('profile');
							if(count($users)) {
								foreach($users as $u) {
							?>
							<option value="<?=$u['id'];?>" <? if(isset($_GET['flt']['profile'])) {if($this->Azbn7->c_s($_GET['flt']['profile']) == $u['id']) { echo 'selected';}} ?> ><?=$u['login'];?></option>
							<?
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="col-xs-4" >
					<div class="form-group">
						
						<div class="row " >
							<div class="col-xs-12 col-sm-6" >
								<label >Дата записи между</label>
								<input type="text" class="form-control datepicker " name="flt[created_at][start]" value="<?=isset($_GET['flt']['created_at']['start']) ? $this->Azbn7->c_s($_GET['flt']['created_at']['start']) : '';?>" placeholder="Начало" />
							</div>
							
							<div class="col-xs-12 col-sm-6" >
								<label >&nbsp;</label>
								<input type="text" class="form-control datepicker " name="flt[created_at][stop]" value="<?=isset($_GET['flt']['created_at']['stop']) ? $this->Azbn7->c_s($_GET['flt']['created_at']['stop']) : '';?>" placeholder="Окончание" />
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="col-xs-2" >
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
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th class="at-center" >ID</th>
				<th class="at-center" >Дата</th>
				<th class="" >Действие</th>
				<th class="at-center" >Запись</th>
				<th class="at-center" >Пользователь / профиль</th>
				<th class="at-center" >Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($param['items'] as $k => $v) {
		
		?>
		
			<tr>
				<th class="at-center" scope="row"><?=$v['id'];?></th>
				<td class="at-center" ><?=date('d.m.Y H:i', $v['created_at']);?></td>
				<td class=" " >
					<?=$v['uid'];?>
				</td>
				<td class="at-center" >
					<?
					if($v['entity'] > 0) {
						echo $v['entity'];
					}
					?>
				</td>
				<td class="at-center" ><?=$v['user'];?> / <?=$v['profile'];?></td>
				<td class="at-center" >
					<?
					if($v['entity'] > 0) {
					?>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $v['entity'] . '/');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Редактировать запись" ></i></a>
					<?
					}
					?>
				</td>
			</tr>
		
		<?
		
	}
	?>
		</tbody>
	</table>
	<?
}

$this->Azbn7->mdl('Viewer')->tpl('_/pagination', $param);
?>