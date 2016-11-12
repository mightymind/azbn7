<?
// Административный шаблон
?>

<?
$sysopt = $this->Azbn7->mdl('DB')->read('sysopt');

if(count($sysopt)) {
	foreach($sysopt as $k => $v) {
		
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


<?
$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/select', array(
	'html' => 'class="" id=""',
	'hierarchy' => $entity_type_h,
	'start_index' => 0,
));
?>

<p><a href="/admin/logout/" >Выйти</a></p>