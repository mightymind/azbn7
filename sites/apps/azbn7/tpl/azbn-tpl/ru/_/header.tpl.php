<?
// header сайта
?><!DOCTYPE html>
<html class="no-js" >
<head>

<?
$this->Azbn7->mdl('Site')->showSEOHeader($param['entity']);
?>

<meta name="referrer" content="no-referrer" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!--
<meta name="document-state" content="Dynamic" />
<meta name="resource-type" content="document" />
-->

<meta HTTP-EQUIV="Cache-Control" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link type="image/x-icon" href="<?=$this->Azbn7->mdl('Site')->url('/favicon.ico');?>" rel="shortcut icon" />
<link type="image/x-icon" href="<?=$this->Azbn7->mdl('Site')->url('/favicon.ico');?>" rel="icon" />

<meta property="og:image" content="<?=$this->Azbn7->mdl('Site')->url('/favicon.ico');?>" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/modernizr-custom.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/device.min.js');?>" ></script>

<?
/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.head.after')
;
/* --------- /ext__event ---------- */
?>

</head>
<body class="<?=$this->Azbn7->mdl('Viewer')->bodyClass('');?>" <? if($this->Azbn7->config['debug']) { ?>data-php-process-session="<?=$this->Azbn7->php_process_session;?>"<? } ?> data-fecss-jssearch="" data-fecss-modal="no-modal" data-context="container" >

<div class="azbn7-container" >