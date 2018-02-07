<?
// footer админки
?>
		
		</div>
		
	</div>
	
	<div class="admin-action-line" data-state="hide" >
		<div class="text" >Как здорово, что все мы здесь сегодня собрались!</div>
	</div>

</div><!-- /container-fluid azbn7-container -->


<div class="modal fade azbn7-multiple-upload" tabindex="-1" role="document" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Выберите файлы для загрузки</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="row" >
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						
						<p><a class="upload-on-click-btn" href="#upload-on-click" >Выберите</a> файлы для загрузки или перетащите их на поле загрузки ниже</p>
						<p>Загруженные файлы будут проанализированы и добавлены в соответствующие разделы.</p>
						
						<div class="jumbotron upload-on-drag-area" ></div>
						
					</div>
					
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" >Закрыть</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade azbn7-select-entity" tabindex="-1" role="document" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Выберите записи</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
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


<div class="modal fade" id="modal-entity_type-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Создание типа данных</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
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


<datalist id="input-list-types-0">
	<option value="BIGINT DEFAULT '0'">
	<option value="DATE NOT NULL">
	<option value="DOUBLE DEFAULT '0'">
	<option value="INT DEFAULT '0'">
	<option value="FLOAT DEFAULT '0'">
	<option value="BLOB DEFAULT ''">
	<option value="TEXT DEFAULT ''">
	<option value="MEDIUMBLOB DEFAULT ''">
	<option value="MEDIUMTEXT DEFAULT ''">
	<option value="TINYINT DEFAULT '0'">
	<option value="VARCHAR(256) DEFAULT ''">
</datalist>

<datalist id="input-list-editors-0">
	<option value="email">
	<option value="hidden">
	<option value="input">
	<option value="pass">
	<option value="pos">
	<option value="textarea">
	<option value="upload">
	<option value="uploadimg">
	<option value="visible">
	<option value="wysiwyg">
</datalist>

<datalist id="input-list-wysiwyg-0">
	<option value="ckeditor">
	<option value="cleditor">
	<option value="textarea">
	<option value="tinymce">
</datalist>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/azbn7-admin.css');?>" />
<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/font-awesome/css/font-awesome.min.css');?>" />


<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/jquery-plugin/Azbn7_AjaxUploader.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/jquery-plugin/Azbn7_ImageMinimizer.js');?>" ></script>

<!-- jQuery UI 1.12.1 -->
<link href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/jquery-ui-1.12.1/jquery-ui.min.css');?>" rel="stylesheet">
<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/jquery-ui-1.12.1/jquery-ui.min.js');?>" ></script>
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>-->
<!-- /jQuery UI 1.12.1 -->

<!-- Yandex Maps API -->
<script src="//api-maps.yandex.ru/2.1/?load=package.controls,package.standard,package.geoObjects,package.editor&lang=ru-RU" type="text/javascript"></script>
<!-- /Yandex Maps API -->



<?
switch($_SESSION['user']['param']['wysiwyg']) {
	
	case 'cleditor' : {
		?>
		
		<!-- CLEditor -->
		<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/cleditor/jquery.cleditor.css');?>" />
		<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/cleditor/jquery.cleditor.min.js');?>"></script>
		<script>
		jQuery(function(){
			
			var $ = jQuery;
			
			$('.azbn7-cleditor').cleditor({
				docType : '<!DOCTYPE html>',
			});
			
		});
		</script>
		<!-- /CLEditor -->
		
		<?
	}
	break;
	
	case 'ckeditor' : {
		?>
		
		<!-- CKEditor -->
		<!--<script src="//cdn.ckeditor.com/4.6.0/full/ckeditor.js"></script>-->
		<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/ckeditor/ckeditor.js');?>"></script>
		<script>
		CKEDITOR.disableAutoInline = true;
		</script>
		<!-- /CKEditor -->
		
		<?
	}
	break;
	
	case 'tinymce' : {
		?>
		
		<!-- TinyMCE -->
		<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
		<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/tinymce/tinymce.min.js');?>"></script>
		<script>
		jQuery(function(){
			
			var $ = jQuery;
			
			tinymce.init({
				selector:'.azbn7-tinymce',
				height : '500px',
				theme : 'modern',
				plugins: [
					'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime media nonbreaking save table contextmenu directionality',
					'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc',
				],
				toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
				image_advtab: true,
				content_css: [
					//'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
					//'//www.tinymce.com/css/codepen.min.css'
				],
			});
			
		});
		</script>
		<!-- /TinyMCE -->
		
		<?
	}
	break;
	
	default : {
		
	}
	break;
	
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/jquery.azbn7.js');?>" ></script>
<?
/*
if($this->Azbn7->mdl('Site')->is('user')) {
?>
<script>
window.Azbn7.me('user', function(type, entity){
	
	console.log('I am ' + type + ' with ID ' + entity.id);
	
});

window.Azbn7.me('profile', function(type, entity){
	console.log('I am ' + type + ' with ID ' + entity.id);
});
</script>
<?
}
*/
?>

<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/document-ready.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/admin/document-ready.js');?>" ></script>
<!--<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/mdl/user.mdl.js');?>" ></script>-->

<?
$this->Azbn7->mdl('Viewer')->tpl('_/notifies_as-js', array());
?>


<?
/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.footer.body.after', $param)
;
/* --------- /ext__event ---------- */
?>


<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter44096394 = new Ya.Metrika({ id:44096394, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/44096394" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->


<!--
административный шаблон
-->

</body>
</html>