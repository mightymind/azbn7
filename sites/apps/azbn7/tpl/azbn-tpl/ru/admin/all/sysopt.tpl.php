<?
// Административный шаблон
?>



<h2 class="mt-2 mb-1" >
	Параметры CMS
	
	<div class="float-xs-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/sysopt/');?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	
</h2>


<?
if(count($param['items'])) {
	
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
	foreach($param['items'] as $k => $v) {
		
		?>
		
			<tr>
				<th scope="row"><?=$v['id'];?></th>
				<td><?=$v['uid'];?></td>
				<td><?=$sysopt_data[$v['uid']];?></td>
				<td><?=$v['value'];?></td>
				<td class="item-edit-functions" >
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