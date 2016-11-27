<?
// sidebar админки
?>
	
	<h2 class="mt-2 mb-1" >&nbsp;</h2>
	
	<form class=" " action="<?=$this->Azbn7->mdl('Site')->url('/admin/search/');?>" >
		<div class="form-group">
			<input type="text" name="text" class="form-control azbn7-search-input" data-result="fast-search-result" data placeholder="Быстрый поиск..." autocomplete="off" />
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
	