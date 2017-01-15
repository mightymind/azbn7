<?
// уведомления

$ntf = $this->Azbn7->mdl('Session')->getNotifies('user');

if(count($ntf)) {

?>

	<?
	foreach($ntf as $n) {
	?>
	
		<div class="alert alert-<?=$n['type'];?>" role="<?=$n['type'];?>">
			<?=$n['title'];?>
		</div>
		
	<?
	}
	?>

<?

}