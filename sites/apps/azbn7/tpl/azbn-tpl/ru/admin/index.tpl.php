<?
// Административный шаблон
?>


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
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/sysopt/' . $v['id'] . '/');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Редактировать" ></i></a>
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