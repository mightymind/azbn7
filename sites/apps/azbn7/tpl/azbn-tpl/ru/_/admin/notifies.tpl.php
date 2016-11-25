<?
// уведомления

$ntf = $this->Azbn7->mdl('Session')->getNotifies('user');

if(count($ntf)) {

?>

<div class="row" >
	
	<?
	foreach($ntf as $n) {
	?>
	<div class="col-md-6 col-lg-4 " >
		
		<div class="alert alert-<?=$n['type'];?>" role="<?=$n['type'];?>">
			<strong>Отлично!</strong> <?=$n['title'];?>
		</div>
		
	</div>
	<?
	}
	?>
	
</div>

<?

}