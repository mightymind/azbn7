<?
// header админки

$this->Azbn7->mdl('Viewer')->setAzbn7BodyConfig();

?><!DOCTYPE html>
<html lang="ru" class="no-js" >
<head>

<title><?=isset($param['entity']['item']['title']) ? $param['entity']['item']['title'] : '';?></title>
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


<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous" />-->
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/dashboard.css');?>" />-->
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/signin.css');?>" />-->
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/azbn7.css');?>" />-->
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/azbn7-admin.css');?>" />-->
<!--<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/css/font-awesome/css/font-awesome.min.css');?>" />-->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/modernizr.min.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/device.min.js');?>" ></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/var/style/azbn7/js/jquery.min.js');?>" ></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->



<?
/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.head.after')
;
/* --------- /ext__event ---------- */
?>


</head>
<body class="<?=$this->Azbn7->mdl('Viewer')->bodyClass('');?>" <?=$this->Azbn7->mdl('Viewer')->bodyDataAttrs('');?> >

<?
/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.body.before', $param)
;
/* --------- /ext__event ---------- */
?>

<!--
<div class="azbn7-preloader" >
	
	<a href="#" class="azbn7-preloader__cancel-btn" >
		
	</a>
	
</div>
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	
	<a class="navbar-brand" href="<?=$this->Azbn7->mdl('Site')->url('/admin/');?>">CMS Azbn7</a>
	
	<button type="button" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" >
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div id="navbarResponsive" class="collapse navbar-collapse" >
		
		<ul class="nav navbar-nav mr-auto nav-inline">
			
			<li class="nav-item "><div class="divider"></div></li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text-o" aria-hidden="true"></i> Контент</a>
				<div class="dropdown-menu">
					<?
					$types = $this->Azbn7->mdl('DB')->read('entity_type', "fill = '1'");
					if(count($types)) {
						foreach($types as $t) {
							
							if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.type.' . $t['uid'] . '.access')) {
							?>
							<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $t['id']);?>" ><?=$t['title'];?></a>
							<?
							}
							
						}
					}
					?>
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.upload')) {
					?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#multiple-upload" data-toggle="modal" data-target=".azbn7-multiple-upload" ><i class="fa fa-cloud-upload" aria-hidden="true"></i> Массовая загрузка файлов</a>
					<?
					}
					?>
					
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i> Пользователи</a>
				<div class="dropdown-menu">
					
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.user.all.access')) {
					?>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/user/');?>" ><i class="fa fa-user-secret" aria-hidden="true"></i> Админы</a>
					<?
					}
					?>
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.profile.all.access')) {
					?>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/profile/');?>" ><i class="fa fa-user-o" aria-hidden="true"></i> Профили пользователей</a>
					<?
					}
					?>
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.log.all.access')) {
					?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/log/');?>" ><i class="fa fa-history" aria-hidden="true"></i> Логи</a>
					<?
					}
					?>
					
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i> Параметры</a>
				<div class="dropdown-menu">
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.right.all.access')) {
					?>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/right/');?>" ><i class="fa fa-universal-access" aria-hidden="true"></i> Права пользователей</a>
					<?
					}
					?>
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.alias.all.access')) {
					?>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/alias/');?>" ><i class="fa fa-random" aria-hidden="true"></i> Синонимы</a>
					<?
					}
					?>

					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.state.all.access')) {
					?>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/state/');?>" ><i class="fa fa-check-circle" aria-hidden="true"></i> Состояния</a>
					<?
					}
					?>
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity_type.all.access')) {
					?>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity_type/');?>" ><i class="fa fa-folder-open" aria-hidden="true"></i> Типы данных</a>
					<?
					}
					?>
					
					<?
					if($this->Azbn7->mdl('Session')->hasRight('user', 'site.sysopt.all.access')) {
					?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/sysopt/');?>" ><i class="fa fa-cogs" aria-hidden="true"></i> Настройки CMS</a>
					<?
					}
					?>
					
					<?
					/* ---------- ext__event ---------- */
					$this->Azbn7
						->mdl('Ext')
							->event($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.body.navbar.settings.after')
					;
					/* --------- /ext__event ---------- */
					?>
					
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
		
		<ul class="nav navbar-nav nav-inline">
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus" aria-hidden="true"></i> Создать</a>
				<div class="dropdown-menu">
					<?
					$types = $this->Azbn7->mdl('DB')->read('entity_type', "fill = '1'");
					if(count($types)) {
						foreach($types as $t) {
							
							if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.type.' . $t['uid'] . '.access')) {
							?>
							<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $t['id']);?>" ><?=$t['title'];?></a>
							<?
							}
							
						}
					}
					?>
				</div>
			</li>
			
			<li class="nav-item">
				<a class="nav-link " href="<?=$this->Azbn7->mdl('Site')->url('/admin/logout/');?>" ><i class="fa fa-user-times" aria-hidden="true"></i> Выйти</a>
			</li>
			
		</ul>
		
		<!--
		<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/search/');?>" class="float-sm-right">
			<input type="text" name="text" class="form-control" placeholder="Поиск...">
		</form>
		-->
		
	</div>
</nav>

<div class="container-fluid azbn7-container ">
	
	<div class="row">
		
		<div class="col-12 col-xl-2 mt-2 azbn7-user-msg-cont" >
			
			<?
			//$this->Azbn7->mdl('Viewer')->tpl('_/notifies', array());
			?>
			
		</div>
		
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10" >
		