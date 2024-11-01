// JavaScript Document
jQuery(document).ready(function() {
	jQuery("a.aslinks").mouseover(function() {
		jQuery(this).children(".tip").show();
	});
	jQuery("a.aslinks").mouseout(function() {
		jQuery(this).children(".tip").hide();
	});
});