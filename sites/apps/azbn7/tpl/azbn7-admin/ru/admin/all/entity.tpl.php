<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >
	<?=$param['type']['title'];?>. Записи
	
	<div class="float-xs-right item-base-functions" >
		<a href="#" title="Фильтр записей" ><i class="fa fa-filter" aria-hidden="true"></i></a>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $param['type']['id']);?>" title="Создать запись" ><i class="fa fa-plus-circle" aria-hidden="true" ></i></a>
	</div>
	
</h2>


<?

if(count($param['items'])) {
	?>
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th class="at-center" >ID</th>
				<th class="at-center" >Отобр.</th>
				<th>Название</th>
				<th class="at-center" >Дата создания</th>
				<th class="at-center" >Дата изменения</th>
				<th class="at-center" >Функции</th>
			</tr>
		</thead>
		<tbody>
	
	<?
	foreach($param['items'] as $v) {
		
		$item = $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('DB')->prefix . '_' . $param['type']['uid'], "entity = '{$v['id']}'");
		
		?>
			
			<tr>
				<th class="at-center" scope="row"><?=$v['id'];?></th>
				<td class="at-center" ><?=($v['visible'] ? '<i class="fa fa-check" aria-hidden="true" title="Отображается" ></i>' : '');?></td>
				<td>
					<?=$item['title'];?>
					<br />
					<a href="<?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?>" target="_blank" ><?=$this->Azbn7->mdl('Site')->url('/' . $v['url'] . '/');?></a>
				</td>
				<td class="at-center" ><?=date('d.m.Y H:i', $v['created_at']);?></td>
				<td class="at-center" ><?=date('d.m.Y H:i', $v['updated_at']);?></td>
				<td class="at-center item-edit-functions" >
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity_seo/' . $v['id'] . '/');?>" title="SEO-настройки и продвижение" ><i class="fa fa-google" aria-hidden="true"></i></a>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $v['id'] . '/');?>" title="Редактировать" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/delete/entity/' . $v['id'] . '/');?>" class="delete-confirm " title="Удалить" ><i class="fa fa-times" aria-hidden="true" ></i></a>
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