<?
// footer админки
?>
		
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 " >
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/sidebar/default', $param);
			?>
			
		</div>
		
	</div>

</div><!-- /container-fluid azbn7-container -->



<div class="modal fade azbn7-select-entity" tabindex="-1" role="document" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Выберите записи</h4>
			</div>
			<div class="modal-body">
				
				<div class="row" >
					
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8" >
						
						<form class=" " action="<?=$this->Azbn7->mdl('Site')->url('/admin/search/');?>" >
							<div class="form-group">
								<input type="search" name="text" class="form-control azbn7-search-input" autocomplete="off" data-result="search-entity-result" placeholder="Быстрый поиск записей..." />
							</div>
							
							<div class="list-group searched-entities-list" data-result="search-entity-result" >
								<!--
								<a href="#" class="list-group-item list-group-item-action ">
									<h5 class="list-group-item-heading">Название сущности</h5>
									<p class="list-group-item-text">Описание найденной сущности</p>
								</a>
								-->
							</div>
						</form>
						
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4" >
						
						<div class=" " >
							<div class="form-group " >
								<label>Выбранные записи</label>
							</div>
							
							<div class="list-group selected-entities-list">
								<a href="#" class="list-group-item disabled">Cras justo odio</a>
								<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
								<a href="#" class="list-group-item">Morbi leo risus</a>
								<a href="#" class="list-group-item">Porta ac consectetur ac</a>
								<a href="#" class="list-group-item">Vestibulum at eros</a>
							</div>
						</div>
						
					</div>
					
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal" >Отмена</button>
				<button type="button" class="btn btn-success azbn7-select-entity-ok" data-dismiss="modal" >OK</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<div class="modal fade" id="modal-entity-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				
				<div class="list-group">
					<a href="#" class="list-group-item disabled">Cras justo odio</a>
					<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
					<a href="#" class="list-group-item">Morbi leo risus</a>
					<a href="#" class="list-group-item">Porta ac consectetur ac</a>
					<a href="#" class="list-group-item">Vestibulum at eros</a>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="modal-entity-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="modal-entity_type-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Создание типа данных</h4>
			</div>
			<div class="modal-body azbn7-container">
				
				<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/entity_type/');?>" method="POST" >
					
					<div class="form-group row pb-1">
						<div class="col-xs-12 " >
					<?
					$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
					$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

					$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/select', array(
						'html' => 'class="form-control " id="" name="item[parent]"',
						'hierarchy' => $entity_type_h,
						'start_index' => 0,
						'title' => 'Выберите родительский тип',
					));
					?>
						</div>
					</div>
					
					<div class="form-group row pb-1">
						<div class="col-xs-12 " >
							<label>Строка, определяющая название типа (латинск.)</label>
							<input type="text" class="form-control " name="item[uid]" value="" placeholder="Уникальный ID" />
						</div>
					</div>
					
					<div class="form-group row pb-1">
						<div class="col-xs-12 " >
							<label>Название (или описание) типа (рус.)</label>
							<input type="text" class="form-control " name="item[title]" value="" placeholder="Название (пояснение)" />
						</div>
					</div>
					
					<div class="field-list pb-1" >
						
						<div class="field-item row " >
							<div class="col-xs-4" >
								<div class="form-group">
									<input type="" class="form-control " name="item[param][field][0][uid]" value="" placeholder="Название поля" />
								</div>
							</div>
							<div class="col-xs-4" >
								<div class="form-group">
									<input type="" class="form-control " name="item[param][field][0][type]" value="" placeholder="Тип поля (MySQL)" />
								</div>
							</div>
							<div class="col-xs-4" >
								<div class="form-group">
									<input type="" class="form-control " name="item[param][field][0][editor]" value="" placeholder="Редактировать через" />
								</div>
							</div>
						</div>
						
						<div class="btn-panel pb-1" >
							<input type="button " class="btn btn-info btn-sm btn-add-item" value="Добавить поле" />
						</div>
						
					</div>
					
					<div>
						<input type="submit" class="btn btn-success " value="Создать" />
					</div>
					
				</form>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/azbn7.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/document-ready.js');?>" ></script>

<!--
административный шаблон
-->

</body>
</html>