<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<h1><?=$param['type']['title'];?></h1>

<form action="/admin/create/entity/" method="POST" >
	
	<input type="hidden" name="type[id]" value="<?=$param['type']['id'];?>" />
	
	<?
	//var_dump($param['type']);
	if(count($param['type']['param']['field'])) {
		foreach($param['type']['param']['field'] as $k => $v) {
			$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/' . $v['editor'], array(
				'title' => $v['title'],
				'html' => ' class="" id="" ',
				'name' => 'item[' . $k . ']',
				'value' => '',
				'path' => 'entity',
			));
		}
	}
	?>
	
	<div>
		<input type="submit" value="Создать" />
	</div>
	
</form>