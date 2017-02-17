<?
// footer сайта
?>

</div><!-- /container-fluid azbn7-container -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/modernizr-custom.js');?>" ></script>
<script src="<?=$this->Azbn7->mdl('Site')->url('/js/device.min.js');?>" ></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/jquery.min.js');?>" ></script>

<script defer src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/azbn7.js');?>" ></script>

<script defer src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/document-ready.js');?>" ></script>

<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/css/azbn7/azbn7.css');?>" />


<?
/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.footer.body.after', $param)
;
/* --------- /ext__event ---------- */
?>


<?=$this->Azbn7->mdl('Site')->sysopt_get('site.counters.content');?>

</body>
</html>