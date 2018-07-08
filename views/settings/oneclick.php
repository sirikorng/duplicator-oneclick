<?php

global $wp_version;
global $wpdb;

$action_updated = null;
$action_response = __("OneClick Settings Saved", 'duplicator');

//SAVE RESULTS
if (isset($_POST['action']) && $_POST['action'] == 'save') {

	//Nonce Check
	if (!isset($_POST['dup_settings_save_nonce_field']) || !wp_verify_nonce($_POST['dup_settings_save_nonce_field'], 'dup_settings_save')) {
		die('Invalid token permissions to perform this request.');
	}
	
	DUP_Settings::Save();
	$action_updated = true;
}
?>

<form id="dup-settings-form" action="<?php echo admin_url('admin.php?page=duplicator-settings&tab=oneclick'); ?>" method="post">
    <?php wp_nonce_field('dup_settings_save', 'dup_settings_save_nonce_field', false); ?>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="page"   value="duplicator-settings">
    
    <?php if ($action_updated) : ?>
        <div id="message" class="notice notice-success is-dismissible dup-wpnotice-box"><p><?php echo $action_response; ?></p></div>
    <?php endif; ?>

    <h3 class="title"><?php _e("ShortCodes", 'duplicator') ?> </h3>
    <hr size="1" />
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><label><?php _e("Create Shop Button", 'duplicator'); ?></label></th>
            <td><?php echo "create_shop"?></td>
        </tr>
        <tr valign="top">
            <th scope="row"><label><?php _e("View Shop Button", 'duplicator'); ?></label></th>
            <td><?php echo "view_shop"?></td>
        </tr>
    </table>
</form>

<script>
jQuery(document).ready(function($) 
{
});
</script>