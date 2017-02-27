<?
// уведомления

$ntf = $this->Azbn7->mdl('Session')->getNotifies('user');

if(count($ntf)) {

?>
<script>
	
	$(function(){
		
		$.Azbn7.mdl('fnc').include('/js/azbn7/mdl/user.mdl.js', function(){
			
			<?
			foreach($ntf as $n) {
			?>
			
			$.Azbn7.mdl('User').notify('<?=$n['type'];?>', '<?=$n['title'];?>');
			
			<?
			}
			?>
			
		});
		
	});
	
</script>
<?

}