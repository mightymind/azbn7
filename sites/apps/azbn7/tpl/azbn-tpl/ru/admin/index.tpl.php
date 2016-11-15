<?
// Административный шаблон
?>


<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 " >
	
	<h2 class="mt-2 mb-1" >CMS Azbn7. Управление сайтом</h2>
	
	<!--
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Username</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
			</tr>
			<tr>
				<th scope="row">2</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@TwBootstrap</td>
			</tr>
		</tbody>
	</table>
	-->
	
	<?
$sysopt = $this->Azbn7->mdl('DB')->read('sysopt');

if(count($sysopt)) {
	
	$sysopt_data = array();
	$sysopt_data_raw = $this->Azbn7->mdl('DB')->read('sysopt_data');
	if(count($sysopt_data_raw)) {
		foreach($sysopt_data_raw as $opt) {
			$sysopt_data[$opt['uid']] = $opt['title'];
		}
	}
	
	?>
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th>ID</th>
				<th>Параметр</th>
				<th>Описание</th>
				<th>Значение</th>
				<th>Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($sysopt as $k => $v) {
		
		?>
		
			<tr>
				<th scope="row"><?=$v['id'];?></th>
				<td><?=$v['uid'];?></td>
				<td><?=$sysopt_data[$v['uid']];?></td>
				<td><?=$v['value'];?></td>
				<td>
					<?
					if($v['editable']) {
						?>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/sysopt/' . $v['id'] . '/');?>" >Редактировать</a>
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
?>


<?
/*
$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/select', array(
	'html' => 'class="" id=""',
	'hierarchy' => $entity_type_h,
	'start_index' => 0,
	'hide_zero' => 0,
));
*/
?>

</div>


<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 " >
	
	<h2 class="mt-2 mb-1" >&nbsp;</h2>
	
	<form class=" " action="<?=$this->Azbn7->mdl('Site')->url('/admin/search/');?>" >
		<div class="form-group">
			<input type="text" name="text" class="form-control azbn7-search-input" data-result="fast-search-result" data placeholder="Быстрый поиск...">
		</div>
		
		<div class="list-group" data-result="fast-search-result" >
			<!--
			<a href="#" class="list-group-item list-group-item-action ">
				<h5 class="list-group-item-heading">Название сущности</h5>
				<p class="list-group-item-text">Описание найденной сущности</p>
			</a>
			-->
		</div>
	</form>
	
	<hr />
	
	
	<?
	$types = $this->Azbn7->mdl('DB')->read('entity_type');
	if(count($types)) {
	?>
	<div class="dropdown ">
		<button type="button" class="btn btn-danger btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Добавить
		</button>
		<div class="dropdown-menu">
			<!--
			<a class="dropdown-item" href="#_" data-toggle="modal" data-target="#modal-entity_type-add" >Тип данных</a>
			<div class="dropdown-divider"></div>
			-->
			
			<?
			foreach($types as $t) {
				?>
				<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $t['id']);?>"><?=$t['title'];?></a>
				<?
			}
			?>
		</div>
	</div>
	
	<hr />
	<?
	}
	?>
	
</div>