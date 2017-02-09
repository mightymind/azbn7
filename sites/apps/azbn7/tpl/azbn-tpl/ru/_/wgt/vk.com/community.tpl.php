<?
// widget стандартный
?>

<!-- ---------- VK Widget ---------- -->

<script type="text/javascript" src="//vk.com/js/api/openapi.js?139"></script>

<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 4, wide: 1, width: "auto", height: "400", color3: '185EAD'}, <?=$param['group_id'];?>);
</script>

<!-- ---------- /VK Widget ---------- -->
