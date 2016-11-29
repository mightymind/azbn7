<?
// sitemap сайта

//var_dump($param['items']);

echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" >
<?

if(count($param['items'])) {
	foreach($param['items'] as $entity) {

//$_SERVER['SERVER_NAME']
?>
<url>
<loc>http://<?=$_SERVER['HTTP_HOST'];?><?=$this->Azbn7->mdl('Site')->url('/' . $entity['url'] . '/');?></loc>
<lastmod><?=date("Y-m-d", $entity['updated_at']);?></lastmod>
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
<?
	}
}

?>
</urlset>