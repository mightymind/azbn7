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
				<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/sysopt/' . $v['id'] . '/');?>" >Редактировать</a>
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

<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/sysopt/');?>" >Добавить</a>