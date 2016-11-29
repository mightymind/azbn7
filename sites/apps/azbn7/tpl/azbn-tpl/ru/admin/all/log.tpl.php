<?
// Административный шаблон
?>



<h2 class="mt-2 mb-1" >
	Логи сайта
	
	<!--
	<div class="float-xs-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/user/');?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	-->
	
</h2>


<?
if(count($param['items'])) {
	
	?>
	
	<table class="table table-bordered table-striped table-hover ">
		<thead>
			<tr>
				<th class="at-center" >ID</th>
				<th class="at-center" >Дата</th>
				<th class="" >Действие / Запись</th>
				<th class="at-center" >Пользователь / профиль</th>
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
					<br />
					<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $v['entity'] . '/');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Редактировать запись" ></i></a>
				</td>
				<td class="at-center" ><?=$v['user'];?> / <?=$v['profile'];?></td>
			</tr>
		
		<?
		
	}
	?>
		</tbody>
	</table>
	<?
}

$this->Azbn7->mdl('Viewer')->tpl('_/admin/pagination', $param);
?>