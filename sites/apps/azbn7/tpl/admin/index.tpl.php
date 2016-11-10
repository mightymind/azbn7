<?
// Административный шаблон
?>

<?
$sysopt = $this->Azbn7->mdl('DB')->read('sysopt');

if(count($sysopt)) {
	foreach($sysopt as $o) {
		
		?>
		
		<p>
			<?=$o['uid'];?>:
			<?
			if($o['editable']) {
				?>
				<input type="text" value="<?=$o['value'];?>" disabled />
				<?
			} else {
				?>
				<?=$o['value'];?>
				<?
			}
			?>
		</p>
		
		<?
		
	}
}
?>
