<?
// Административный шаблон
?>



<h2 class="mt-2 mb-1" >
	Права пользователей
	
	<div class="float-sm-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/right/');?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	
</h2>


<?
if(count($param['items'])) {
	
	?>
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th class="at-center" >ID</th>
				<th class="at-center" >UID</th>
				<th class="at-center" >Название</th>
				<th class="at-center" >Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($param['items'] as $k => $v) {
		
		?>
		
			<tr>
				<th class="at-center" scope="row"><?=$v['id'];?></th>
				<td class="at-center" ><?=$v['uid'];?></td>
				<td class="at-center" ><?=$v['title'];?></td>
				<td class="at-center item-edit-functions" >
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/right/' . $v['id'] . '/');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Редактировать" ></i></a>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/delete/right/' . $v['id'] . '/');?>" class="delete-confirm " ><i class="fa fa-times" aria-hidden="true" title="Удалить" ></i></a>
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