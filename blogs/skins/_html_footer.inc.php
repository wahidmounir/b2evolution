<?php
/**
 * This is the HTML footer include template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * This is meant to be included in a page template.
 * Note: This is also included in the popup: do not include site navigation!
 *
 * @package evoskins
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

if( file_exists( $ads_current_skin_path.'_html_footer.inc.php' ) )
{	// The skin has a customized handler, use that one instead:
	require $ads_current_skin_path.'_html_footer.inc.php';
	return;
}


// Trigger plugin event, which could be used e.g. by a google_analytics plugin to add the javascript snippet here:
$Plugins->trigger_event('SkinEndHtmlBody');

$Hit->log();	// log the hit on this page
debug_info(); // output debug info if requested
?>
</body>
</html>