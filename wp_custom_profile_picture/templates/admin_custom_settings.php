<?php
    settings_errors();
    require_once "display_custom_settings.php";
?>
<form method="post" action="options.php" style="display: inline-block; float: left;">
	<?php settings_fields( 'sh-custom-settings-group' ); ?>
	<?php do_settings_sections( 'custom_settings' ); ?>
	<?php submit_button(); ?>
</form>
