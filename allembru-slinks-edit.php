<?php
global $wpdb;
$table_name = $wpdb->prefix . "aslinks";

if($_POST) {
	$table_name = $wpdb->prefix."aslinks";
	$links = $_POST['link'];
	foreach($links as $key=>$value) {
		if($value['remove']=='true') {
			$wpdb->query("DELETE FROM $table_name WHERE id='".$key."'");
			$success[] = '"<strong>'.$value['current'].'</strong>" has been deleted.';
		} else {
			if($value['text']=="") {
				$error[] = "<strong>Link Text</strong> is required for <strong>".$value['current']."</strong>.";
			}
			if($value['title']=="") {
				$error[] = "<strong>Link Title</strong> is required for <strong>".$value['current']."</strong>.";
			}
			if($value['url']=="") {
				$error[] = "<strong>Link URL</strong> is required for <strong>".$value['current']."</strong>.";
			}
			if($value['openin']=="") {
				$error[] = "<strong>Open In</strong> is required for <strong>".$value['current']."</strong>.";
			}
			if($value['tip_display']=="1") {
				if($value['tip_title']=="") {
					$error[] = "<strong>Tip Title</strong> is required for <strong>".$value['current']."</strong>.";
				}
				if($value['tip_description']=="") {
					$error[] = "<strong>Tip Description</strong> is required for <strong>".$value['current']."</strong>.";
				}
			}
			if(!isset($error)) {
				$wpdb->query("UPDATE $table_name SET text='".$value['text']."', title='".$value['title']."', url='".$value['url']."', openin='".$value['openin']."', tip_display='".$value['tip_display']."', tip_style='".$value['tip_style']."', tip_title='".$value['tip_title']."', tip_description='".$value['tip_description']."', tip_image='".$value['tip_image']."' WHERE id='".$key."'");
			}
		}
	}
	if(!isset($error)) {
		$success[] = "Your links have been updated!";
	}
}

$links = $wpdb->get_results("SELECT * FROM $table_name");
$count = count($links);
?>
<div class="wrap">
    <a href="http://www.allembru.com" target="_blank">
        <img src="<?php echo plugins_url('/img/icon.png', __FILE__); ?>" style="float:left; margin-right:15px;">
    </a>
    <h2>
        <strong>Smart Links by Allembru</strong>
    </h2>
	<?php if(isset($success)) { ?>
        <?php foreach($success as $value) { ?>
            <div id="message" class="updated"><p><?php echo $value; ?></p></div>
        <?php } ?>
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
                    <?php if($count>0) { ?>
                        <form method="post" action="">
                            <?php foreach($links as $link) { ?>
                                <div class="aslinks-widget">
                                    <h3>
                                        <?php echo $link->text; ?>
                                        <div>Edit</div>
                                    </h3>
                                    <div class="aslinks-widget-more">
                                        <label for="link[<?php echo $link->id; ?>][text]">Link Text: <strong style="color:red;">*</strong></label>
                                        <input class="large-text" type="text" name="link[<?php echo $link->id; ?>][text]" value="<?php echo $link->text; ?>" />
                                        <label>Link Title: <strong style="color:red;">*</strong></label>
                                        <input class="large-text" type="text" name="link[<?php echo $link->id; ?>][title]" value="<?php echo $link->title; ?>" />
                                        <label>Link URL: <strong style="color:red;">*</strong></label>
                                        <input class="large-text" type="text" name="link[<?php echo $link->id; ?>][url]" value="<?php echo $link->url; ?>" />
                                        <label>Link Window: <strong style="color:red;">*</strong></label>
                                        <select name="link[<?php echo $link->id; ?>][openin]">
                                            <option value="">Open page in...</option>
                                            <option value="new"<?php if($link->openin=="new") { echo ' selected="selected"'; } ?>>New Window</option>
                                            <option value="current"<?php if($link->openin=="current") { echo ' selected="selected"'; } ?>>Current Window</option>
                                        </select>
                                        <div class="clear"></div>
                                        <hr />
                                        <label>Advanced Tooltip: </label>
                                        <input name="link[<?php echo $link->id; ?>][tip_display]" type="radio" value="1" onclick="showTips('<?php echo $link->id; ?>');"<?php if($link->tip_display==1) { ?> checked="checked"<?php } ?> /><div style="float:left; margin:5px 10px 0 0;">Yes</div>
                                        <input name="link[<?php echo $link->id; ?>][tip_display]" type="radio" value="0" onclick="hideTips('<?php echo $link->id; ?>');"<?php if($link->tip_display==0) { ?> checked="checked"<?php } ?> /><div style="float:left; margin:5px 0 0 0;">No</div>
                                        <div class="clear"></div>
                                        <div id="tip<?php echo $link->id; ?>"<?php if($link->tip_display==0) { ?> style="display:none;"<?php } ?>>
                                            <label>Tip Style: </label>
                                            <input name="link[<?php echo $link->id; ?>][tip_style]" type="radio" value="light"<?php if($link->tip_style=="light") { ?> checked="checked"<?php } ?> /><div style="float:left; margin:5px 10px 0 0;">Light</div>
                                            <input name="link[<?php echo $link->id; ?>][tip_style]" type="radio" value="dark"<?php if($link->tip_style=="dark") { ?> checked="checked"<?php } ?> /><div style="float:left; margin:5px 0 0 0;">Dark</div>
                                            <div class="clear"></div>
                                            <label>Tip Title: <strong style="color:red;">*</strong></label>
                                            <input class="large-text" type="text" name="link[<?php echo $link->id; ?>][tip_title]" value="<?php echo $link->tip_title; ?>" />
                                            <label>Tip Description: <strong style="color:red;">*</strong></label>
                                            <input class="large-text" type="text" name="link[<?php echo $link->id; ?>][tip_description]" value="<?php echo $link->tip_description; ?>" />
                                            <label>Tip Image: </label>
                                            <input class="large-text" type="text" name="link[<?php echo $link->id; ?>][tip_image]" value="<?php echo $link->tip_image; ?>" id="upload_image_<?php echo $link->id; ?>" />
                                            <label>&nbsp;</label>
                                            <input class="button-primary upload_image_button" data-id="<?php echo $link->id; ?>" type="button" value="Upload/Select Image" />
                                            <div class="clear"></div>
                                        </div>
                                        <hr />
                                        <label>Delete: </label>
                                        <input type="checkbox" name="link[<?php echo $link->id; ?>][remove]" value="true" /> <small>Checking this box will remove "<?php echo $link->text; ?>" from your Smart Links list.</small>
                                        <input type="hidden" name="link[<?php echo $link->id; ?>][current]" value="<?php echo $link->text; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $link->id; ?>" />
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php submit_button(); ?>
                        </form>
                    <?php } else { ?>
                        <p>You do not have any links setup at this time.</p>
                    <?php } ?>
                </div>
            </td>
            <td width="250" valign="top">
            	<?php require_once('inc/right.php'); ?>
            </td>
        </tr>
    </table>
</div>

