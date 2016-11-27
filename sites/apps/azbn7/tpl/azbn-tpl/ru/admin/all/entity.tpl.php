<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >
	<?=$param['type']['title'];?>. Записи
	
	<div class="float-xs-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $param['type']['id']);?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	
</h2>


<?

if(count($param['items'])) {
	?>
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th>ID</th>
				<th>Название</th>
				<th>Дата созд./изм.</th>
				<th>Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($param['items'] as $v) {
		
		$item = $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('DB')->prefix . '_' . $param['type']['uid'], "entity = '{$v['id']}'");
		
		?>
			
			<tr>
				<th scope="row"><?=$v['id'];?></th>
				<td>
					<?=$item['title'];?>
					<br />
					<a href="<?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?>" target="_blank" ><?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?></a>
				</td>
				<td><?=date('d.m.Y H:i', $v['created_at']);?> / <?=date('d.m.Y H:i', $v['updated_at']);?></td>
				<td class="item-edit-functions" >
					<a href="<?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?>" target="_blank" ><i class="fa fa-eye" aria-hidden="true" title="Открыть" ></i></a>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $v['id'] . '/');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Редактировать" ></i></a>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/delete/entity/' . $v['id'] . '/');?>" class="delete-confirm " ><i class="fa fa-times" aria-hidden="true" title="Удалить" ></i></a>
				</td>
			</tr>
			
		<?
	}
	?>
		</tbody>
	</table>
	<?
	
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/pagination', $param);
	
}
?>