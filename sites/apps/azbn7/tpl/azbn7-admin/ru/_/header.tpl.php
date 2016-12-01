<?
// header админки
?><!DOCTYPE html>
<html lang="ru" class="no-js" >
<head>

<title><?=$param['entity']['item']['title'];?></title>
<meta name="description" content="">
<meta name="author" content="">

<meta name="referrer" content="never">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="format-detection" content="telephone=no">

<!--
<meta name="document-state" content="Dynamic" />
<meta name="resource-type" content="document" />
-->

<meta charset="utf-8">
<meta HTTP-EQUIV="Cache-Control" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link type="image/x-icon" href="<?=$this->Azbn7->mdl('Site')->url('/favicon.ico');?>" rel="shortcut icon" />
<link type="image/x-icon" href="<?=$this->Azbn7->mdl('Site')->url('/favicon.ico');?>" rel="icon" />

<meta property="og:image" content="<?=$this->Azbn7->mdl('Site')->url('/favicon.ico');?>" />


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous" />
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/css/azbn7/dashboard.css');?>" />-->
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/css/azbn7/signin.css');?>" />-->
<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/css/azbn7/azbn7-admin.css');?>" />
<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/css/font-awesome/css/font-awesome.min.css');?>" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/modernizr-custom.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/device.min.js');?>" ></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/jquery.min.js');?>" ></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/jquery-plugin/Azbn7_AjaxUploader.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/jquery-plugin/Azbn7_ImageMinimizer.js');?>" ></script>



<!-- CLEditor -->
<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/js/cleditor/jquery.cleditor.css');?>" />
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/cleditor/jquery.cleditor.min.js');?>"></script>
<script>
$(function(){
	
	$('.azbn7-cleditor').cleditor({
		docType : '<!DOCTYPE html>',
	});
	
});
</script>
<!-- /CLEditor -->



<!-- CKEditor -->
<!--<script src="//cdn.ckeditor.com/4.6.0/full/ckeditor.js"></script>-->
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/ckeditor/ckeditor.js');?>"></script>
<script>
CKEDITOR.disableAutoInline = true;
</script>
<!-- /CKEditor -->



<!-- TinyMCE -->
<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/tinymce/tinymce.min.js');?>"></script>
<script>
$(function(){
	
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



</head>
<body class=" <?=$this->Azbn7->mdl('Viewer')->bodyClass('');?>" data-fecss-jssearch="" data-fecss-modal="no-modal" data-context="container" >

<nav class="navbar navbar-dark navbar-fixed-top bg-inverse">
	
	<button type="button" class="navbar-toggler hidden-md-up" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" ></button>
	<a class="navbar-brand" href="<?=$this->Azbn7->mdl('Site')->url('/admin/');?>">CMS Azbn7</a>
	
	<div id="navbarResponsive" class="collapse navbar-toggleable-sm " >
		
		<ul class="nav navbar-nav float-xs-left nav-inline">
			
			<li class="nav-item "><div class="divider"></div></li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text-o" aria-hidden="true"></i> Контент</a>
				<div class="dropdown-menu">
					<?
					$types = $this->Azbn7->mdl('DB')->read('entity_type');
					if(count($types)) {
						foreach($types as $t) {
							?>
							<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $t['id']);?>" ><?=$t['title'];?></a>
							<?
						}
					}
					?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#multiple-upload" data-toggle="modal" data-target=".azbn7-multiple-upload" ><i class="fa fa-cloud-upload" aria-hidden="true"></i> Массовая загрузка файлов</a>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i> Пользователи</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/user/');?>" ><i class="fa fa-user-secret" aria-hidden="true"></i> Админы</a>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/profile/');?>" ><i class="fa fa-user-o" aria-hidden="true"></i> Профили пользователей</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/log/');?>" ><i class="fa fa-history" aria-hidden="true"></i> Логи</a>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i> Параметры</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/alias/');?>" ><i class="fa fa-random" aria-hidden="true"></i> Перенаправления</a>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity_type/');?>" ><i class="fa fa-folder-open" aria-hidden="true"></i> Типы данных</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/sysopt/');?>" ><i class="fa fa-cogs" aria-hidden="true"></i> Настройки CMS</a>
				</div>
			</li>
			
			<!--
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ресурсы</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/');?>" >Администрирование</a>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/');?>" >Главная сайта</a>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/logout/');?>" >Выйти</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="http://azbn.ru/" >Сайт разработчика</a>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/cms/info/');?>" >Информация о CMS</a>
				</div>
			</li>
			-->
			
			<!--
			<li class="nav-item">
				<a class="nav-link " href="<?=$this->Azbn7->mdl('Site')->url('/admin/logout/');?>" >Выйти</a>
			</li>
			-->
			
		</ul>
		
		<!--
		<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/search/');?>" class="float-xs-right">
			<input type="text" name="text" class="form-control" placeholder="Поиск...">
		</form>
		-->
		
	</div>
</nav>

<div class="container-fluid azbn7-container ">
	
	<div class="row">
		
		<?
		/*
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 " >
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/sidebar/default', $param);
			?>
			
		</div>
		*/
		?>
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >
		
		<?
		$this->Azbn7->mdl('Viewer')->tpl('_/notifies', array());
		?>
		