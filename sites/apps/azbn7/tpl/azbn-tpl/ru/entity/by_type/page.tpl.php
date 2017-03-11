<?php

$entity = &$param['entity'];

?>

<?
$this->Azbn7->mdl('Viewer')
	->tpl('_/banner/entity/by_type/page/header', array(
		'__this_tpl' => array(
			'cache' => 1,
			'cache_ttl' => 60,
			'cache_compress' => 1,
		),
	));
?>

<h2><?php echo $this->Azbn7->mdl('Lang')->msg('error.entity.not_found');?></h2>

<div class="content" >
	
	<h1 class="azbn7__live-edit__html" data-azbn7-live-edit="entity.<?=$entity['type']['uid'];?>.<?=$entity['item']['id'];?>.title" ><?=$entity['item']['title'];?></h1>
	
	<div class="azbn7__live-edit__html" data-azbn7-live-edit="entity.<?=$entity['type']['uid'];?>.<?=$entity['item']['id'];?>.content" ><?=$this->Azbn7->mdl('Viewer')->evalContent($entity['item']['content']);?></div>
	
</div>