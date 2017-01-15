<?

?>

	<div class="row">
		<div class="col-sm-3" >
			<select class="form-control azbn-entity-all-mass-select" >
				
				<option value="" >С отмеченными...</option>
				<option value="delete" >Удалить</option>
				<option value="visible=0" >Скрыть от всех</option>
				<option value="visible=5" >Частично скрыть</option>
				<option value="visible=10" >Отобразить</option>
				
				<?
				if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
				?>
				<option value="lock" >Заблокировать от изменений</option>
				<option value="unlock" >Разблокировать записи</option>
				<?
				}
				?>
				
			</select>
		</div>
	</div>