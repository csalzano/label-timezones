<?php
defined( 'ABSPATH' ) or exit;

/**
 * Plugin Name: Label Timezones
 * Plugin URI: https://github.com/csalzano/label-timezones
 * Description: Label the timezones at the bottom of the Timezone drop down in Settings > General
 * Version: 0.1.0
 * Author: Corey Salzano
 * Author URI: https://profiles.wordpress.org/salzano
 * Text Domain: label-timezones
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function maybe_output_timezone_labeling_javascript( $hook )
{
	global $pagenow;
	if( 'options-general.php' != $pagenow )
	{
		return;
	}
?><script type="text/javascript">
<!--
jQuery(document).ready( function() {
	jQuery('#timezone_string option').each( function() {
		if( 'UTC-' != this.value.substring(0,4) )
		{
			return;
		}
		let offset = this.value.substring(3);
		let names = [];
		names[-11] = 'Samoa Time Zone';
		names[-10] = 'Hawaii-Aleutian Time Zone';
		names[-9] = 'Alaska Time Zone';
		names[-8] = 'Pacific Time Zone';
		names[-7] = 'Mountain Time Zone';
		names[-6] = 'Central Time Zone';
		names[-5] = 'Eastern Time Zone';
		names[-4] = 'Atlantic Time Zone';
		names[10] = 'Chamorro Time Zone';
		if( typeof names[Number(offset)] === 'undefined' )
		{
			return;
		}
		this.innerHTML = this.innerHTML + ' (' + names[Number(offset)] + ')';
	});
});
-->
</script><?php
}
add_action( 'admin_footer', 'maybe_output_timezone_labeling_javascript', 99 );
