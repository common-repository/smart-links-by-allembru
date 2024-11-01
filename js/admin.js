// JavaScript Document
jQuery().ready(function() {
	jQuery(".aslinks-widget h3").click(function() {
		jQuery(this).next(".aslinks-widget-more").slideToggle("slow");
	});
	jQuery('.upload_image_button').click(function() {
		id = jQuery(this).data('id');
		formfield = jQuery('#upload_image_'+id).attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery('#upload_image_'+id).val(imgurl);
		tb_remove();
	}
});
function showTips(id) {
	jQuery("#tip"+id).show();
}
function hideTips(id) {
	jQuery("#tip"+id).hide();
}