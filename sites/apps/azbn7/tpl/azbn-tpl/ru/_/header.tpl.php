<?
// header сайта

$this->Azbn7->mdl('Viewer')->setAzbn7BodyConfig();

?><!DOCTYPE html>
<html lang="ru" class="no-js" >
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


<div class="azbn7-container" >