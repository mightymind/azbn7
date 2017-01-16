<?
// уведомления

$ntf = $this->Azbn7->mdl('Session')->getNotifies('user');

if(count($ntf)) {

?>
<script>
	
	$(function(){
	<?
	foreach($ntf as $n) {
	?>
	
	Azbn7.User.notify('<?=$n['type'];?>', '<?=$n['title'];?>');
	
	<?
	}
	?>
	});
	
</script>
<?

}