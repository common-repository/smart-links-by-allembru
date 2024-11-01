<?php
global $wpdb;
$table_name = $wpdb->prefix . "aslinks";
$links = $wpdb->get_results("SELECT * FROM $table_name");
$count = count($links);
if($count>0) {
?>
<script type='text/javascript'>
jQuery().ready(function(e) {
<?php foreach($links as $link) { ?>
<?php
if($link->openin=="new") {
$openin = "_blank";
} else {
$openin = "_self";
}
if($link->tip_display==1) {
if($link->tip_style=='light') {
$newText = "<a class='aslinks ttlight'";
} else {
$newText = "<a class='aslinks ttdark'";
}
$newText .= "href='".$link->url."' target='".$openin."'>".$link->text."<span><div class='ttfirst'></div><strong>".$link->tip_title."</strong><br />";
if($link->tip_image!='') {
$newText .= "<img alt='CSS tooltip image' style='float:right; width:50px; margin:0 0 10px 10px;' src='".$link->tip_image."'>";
}
$newText .= $link->tip_description."<div class='ttlast'>Smart Links by Allembru</div></span></a>";
} else {
$newText = "<a class='aslinks' href='".$link->url."' title='".$link->title."' target='".$openin."'>".$link->text."</a>";
}
?>
jQuery('p').each(function() {
	var strNewString = jQuery(this).html().replace(/\<?php echo $link->text; ?>/g,"<?php echo $newText; ?>");
	jQuery(this).html(strNewString);
});
<?php }	?>
});
</script>
<?php }	?>