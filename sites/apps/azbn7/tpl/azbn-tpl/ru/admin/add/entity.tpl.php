<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<h1><?=$param['type']['title'];?></h1>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/entity/');?>" method="POST" >
	
	<input type="hidden" name="type[id]" value="<?=$param['type']['id'];?>" />
	
	<input type="hidden" name="entity[visible]" value="1" />
	<input type="hidden" name="entity[parent]" value="0" />
	<input type="hidden" name="entity[pos]" value="0" />
	<input type="text" name="entity[url]" value="<?=$this->Azbn7->randstr(16);?>" placeholder="URL" />
	
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