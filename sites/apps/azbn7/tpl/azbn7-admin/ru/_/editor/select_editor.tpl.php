<?
// виджет

$editors = $this->Azbn7->mdl('Site')->sysopt_get('site.admin.editors');

?>

<select class="form-control" name="<?=$param['name'];?>" >
	<?
	if(count($editors)) {
		foreach($editors as $k => $v) {
			?>
			<option value="<?=$k;?>" <? if($param['value'] == $k) {echo 'selected';} ?> ><?=$v;?></option>
			<?
		}
	}
	?>
</select>
