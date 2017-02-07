<?
// footer сайта
?>

</div><!-- /container-fluid azbn7-container -->

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/jquery.min.js');?>" ></script>

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/azbn7.js');?>" ></script>
<?
if($this->Azbn7->mdl('Site')->is('user')) {
?>
<script>
window.Azbn7 = new Azbn7Constructor(jQuery, {
	access_as : 'user',
	key : '<?=$_SESSION['user']['key'];?>',
});
</script>
<?
} else if($this->Azbn7->mdl('Site')->is('profile')) {
?>
<script>
window.Azbn7 = new Azbn7Constructor(jQuery, {
	access_as : 'profile',
	key : '<?=$_SESSION['profile']['key'];?>',
});
</script>
<?
}
?>

<script src="<?=$this->Azbn7->mdl('Site')->url('/js/azbn7/document-ready.js');?>" ></script>

<link rel="stylesheet" href="<?=$this->Azbn7->mdl('Site')->url('/css/azbn7/azbn7.css');?>" />

<?=$this->Azbn7->mdl('Site')->sysopt_get('site.counters.content');?>

</body>
</html>