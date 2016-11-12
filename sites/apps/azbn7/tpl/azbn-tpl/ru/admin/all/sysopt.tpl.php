<?
// Административный шаблон

if(count($param['items'])) {
	foreach($param['items'] as $k => $v) {
		
		?>
		
		<p>
			<?=$v['uid'];?>:
			<?
			if($v['editable']) {
				?>
				<input type="text" value="<?=$v['value'];?>" disabled />
				<?
			} else {
				?>
				<?=$v['value'];?>
				<?
			}
			?>
		</p>
		
		<?
		
	}
}
?>