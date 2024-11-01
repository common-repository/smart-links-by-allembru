<?php 
if($_POST) {
	//validate
	if($_POST['text']=="") {
		$error[] = "<strong>Link Text</strong> is required.";
	}
	if($_POST['title']=="") {
		$error[] = "<strong>Link Title</strong> is required.";
	}
	if($_POST['url']=="") {
		$error[] = "<strong>Link URL</strong> is required.";
	}
	if($_POST['openin']=="") {
		$error[] = "<strong>Open In</strong> is required.";
	}
	if($_POST['tip_display']=="1") {
		if($_POST['tip_title']=="") {
			$error[] = "<strong>Tip Title</strong> is required.";
		}
		if($_POST['tip_description']=="") {
			$error[] = "<strong>Tip Description</strong> is required.";
		}
	}
	if(!isset($error)) {
		global $wpdb;
		$table_name = $wpdb->prefix."aslinks";
		$wpdb->query("INSERT INTO $table_name (text, title, url, openin, tip_display, tip_style, tip_title, tip_description, tip_image) VALUES ('".$_POST['text']."', '".$_POST['title']."', '".$_POST['url']."', '".$_POST['openin']."', '".$_POST['tip_display']."', '".$_POST['tip_style']."', '".$_POST['tip_title']."', '".$_POST['tip_description']."', '".$_POST['tip_image']."')");
		$success = "Your link has been added!";
	}
}
?>

<div class="wrap">
    <a href="http://www.allembru.com" target="_blank">
        <img src="<?php echo plugins_url('/img/icon.png', __FILE__); ?>" style="float:left; margin-right:15px;">
    </a>
    <h2>
        <strong>Smart Links by Allembru: New Link</strong>
    </h2>
	<?php if(isset($success)) { ?>
        <div id="message" class="updated"><p><?php echo $success; ?></p></div>
    <?php } ?>
	<?php if(isset($error)) { ?>
        <?php foreach($error as $value) { ?>
            <div id="message" class="error"><p><?php echo $value; ?></p></div>
        <?php } ?>
    <?php } ?>
    <p><strong style="color:red;">*</strong> Required fields</p>

    <table width="100%">
    	<tr>
        	<td valign="top">
                <div id="slinks-current">
                    <form method="post" action="">
                        <div class="aslinks-widget">
                            <h3>New Link</h3>
                            <div class="aslinks-widget-new">
                                <label for="text">Link Text:</label>
                                <input class="large-text" type="text" name="text" value="" />
                                <label for="title">Link Title:</label>
                                <input class="large-text" type="text" name="title" value="" />
                                <label for="url">Link URL:</label>
                                <input class="large-text" type="text" name="url" value="" />
                                <label for="openin">Open In:</label>
                                <select name="openin">
                                    <option value="" selected="selected">Open page in...</option>
                                    <option value="new">New Window</option>
                                    <option value="current">Current Window</option>
                                </select>
                                <div class="clear"></div>
                                <hr />
                                <label>Advanced Tooltip: </label>
                                <input name="tip_display" type="radio" value="1" onclick="showTips(1);" /><div style="float:left; margin:5px 10px 0 0;">Yes</div>
                                <input name="tip_display" type="radio" value="0" onclick="hideTips(1);" checked="checked" /><div style="float:left; margin:5px 0 0 0;">No</div>
                                <div class="clear"></div>
                                <div id="tip1" style="display:none;">
                                    <label>Tip Style: </label>
                                    <input name="tip_style" type="radio" value="light" checked="checked" /><div style="float:left; margin:5px 10px 0 0;">Light</div>
                                    <input name="tip_style" type="radio" value="dark" /><div style="float:left; margin:5px 0 0 0;">Dark</div>
                                    <div class="clear"></div>
                                    <label>Tip Title: <strong style="color:red;">*</strong></label>
                                    <input class="large-text" type="text" name="tip_title" value="" />
                                    <label>Tip Description: <strong style="color:red;">*</strong></label>
                                    <input class="large-text" type="text" name="tip_description" value="" />
                                    <label>Tip Image: </label>
                                    <input class="large-text" type="text" name="tip_image" value="" id="upload_image_1" />
                                    <label>&nbsp;</label>
                                    <input class="button-primary upload_image_button" data-id="1" type="button" value="Upload/Select Image" />
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <?php submit_button(); ?>
                    </form>
                </div>
            </td>
            <td width="250" valign="top">
            	<?php require_once('inc/right.php'); ?>
            </td>
        </tr>
    </table>
</div>