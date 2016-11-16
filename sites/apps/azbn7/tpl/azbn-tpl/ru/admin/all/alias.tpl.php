<?
// Административный шаблон
?>



<h2 class="mt-2 mb-1" >
	Перенаправления
	
	<div class="float-xs-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/alias/');?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	
</h2>


<?
if(count($param['items'])) {
	
	?>
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th>ID</th>
				<th>Порядок</th>
				<th>Статус подключения</th>
				<th>Виртуальный адрес</th>
				<th>Реальный адрес</th>
				<th>Название</th>
				<th>Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($param['items'] as $k => $v) {
		
		?>
		
			<tr>
				<th scope="row"><?=$v['id'];?></th>
				<td><?=$v['pos'];?></td>
				<td><?=($v['visible'] == 0 ? 'нет' : 'да');?></td>
				<td><?=$v['find'];?></td>
				<td><?=$v['set'];?></td>
				<td><?=$v['title'];?></td>
				<td class="item-edit-functions" >
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/alias/' . $v['id'] . '/');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Редактировать" ></i></a>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/delete/alias/' . $v['id'] . '/');?>" class="" ><i class="fa fa-times" aria-hidden="true" title="Удалить" ></i></a>
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