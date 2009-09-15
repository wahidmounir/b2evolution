<?php
/**
 * This file is part of the evoCore framework - {@link http://evocore.net/}
 * See also {@link http://sourceforge.net/projects/evocms/}.
 *
 * @copyright (c)2009 by Francois PLANQUE - {@link http://fplanque.net/}
 * Parts of this file are copyright (c)2009 by The Evo Factory - {@link http://www.evofactory.com/}.
 *
 * {@internal License choice
 * - If you have received this file as part of a package, please find the license.txt file in
 *   the same folder or the closest folder above for complete license terms.
 * - If you have received this file individually (e-g: from http://evocms.cvs.sourceforge.net/)
 *   then you must choose one of the following licenses before using the file:
 *   - GNU General Public License 2 (GPL) - http://www.opensource.org/licenses/gpl-license.php
 *   - Mozilla Public License 1.1 (MPL) - http://www.opensource.org/licenses/mozilla1.1.php
 * }}
 *
 * {@internal Open Source relicensing agreement:
 * The Evo Factory grants Francois PLANQUE the right to license
 * The Evo Factory's contributions to this file and the b2evolution project
 * under any OSI approved OSS license (http://www.opensource.org/licenses/).
 * }}
 *
 * @package evocore
 *
 * {@internal Below is a list of authors who have contributed to design/coding of this file: }}
 * @author efy-bogdan: Evo Factory / Bogdan.
 * @author fplanque: Francois PLANQUE.
 *
 * @version $Id$
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

/**
 * @var User
 */
global $current_User;
/**
 * @var GeneralSettings
 */
global $Settings;

global $dispatcher;

global $collections_Module;

$Form = & new Form( NULL, 'settings_checkchanges' );
$Form->begin_form( 'fform', '',
	// enable all form elements on submit (so values get sent):
	array( 'onsubmit'=>'var es=this.elements; for( var i=0; i < es.length; i++ ) { es[i].disabled=false; };' ) );

$Form->hidden( 'ctrl', 'registration' );
$Form->hidden( 'action', 'update' );
$Form->hidden( 'tab', 'registration' );

// --------------------------------------------

$Form->begin_fieldset( T_('Default user permissions') );

	$Form->checkbox( 'newusers_canregister', $Settings->get('newusers_canregister'), T_('New users can register'), T_('Check to allow new users to register themselves.' ) );

	$GroupCache = & get_Cache( 'GroupCache' );
	$Form->select_object( 'newusers_grp_ID', $Settings->get('newusers_grp_ID'), $GroupCache, T_('Group for new users'), T_('Groups determine user roles and permissions.') );

	$Form->text_input( 'newusers_level', $Settings->get('newusers_level'), 1, T_('Level for new users'), T_('Levels determine hierarchy of users in blogs.' ), array( 'maxlength'=>1, 'required'=>true ) );

$Form->end_fieldset();

// --------------------------------------------

$Form->begin_fieldset( T_('Email validation') );

	$Form->checkbox( 'newusers_mustvalidate', $Settings->get('newusers_mustvalidate'), T_('New users must validate email'), T_('Check to require users to validate their email by clicking a link sent to them.' ) );

	$Form->checkbox( 'newusers_revalidate_emailchg', $Settings->get('newusers_revalidate_emailchg'), T_('Validate email changes'), T_('Check to require users to re-validate when they change their email address.' ) );

$Form->end_fieldset();

// --------------------------------------------

$Form->begin_fieldset( T_('Security options') );

	$Form->text_input( 'user_minpwdlen', (int)$Settings->get('user_minpwdlen'), 2, T_('Minimum password length'), T_('characters.'), array( 'maxlength'=>2, 'required'=>true ) );

	$Form->checkbox_input( 'js_passwd_hashing', (bool)$Settings->get('js_passwd_hashing'), T_('Login password hashing'), array( 'note'=>T_('Check to enable the login form to hash the password with Javascript before transmitting it. This provides extra security on non-SSL connections.')) );

$Form->end_fieldset();

// --------------------------------------------

if( $current_User->check_perm( 'options', 'edit' ) )
{
	$Form->end_form( array( array( 'submit', 'submit', T_('Save !'), 'SaveButton' ),
													array( 'reset', '', T_('Reset'), 'ResetButton' ) ) );
}

/*
 * $Log$
 * Revision 1.4  2009/09/15 09:20:50  efy-bogdan
 * Moved the "email validation" and the "security options" blocks to the Users -> Registration tab
 *
 * Revision 1.3  2009/09/15 02:43:35  fplanque
 * doc
 *
 * Revision 1.2  2009/09/15 01:39:16  fplanque
 * minor
 *
 * Revision 1.1  2009/09/14 12:01:00  efy-bogdan
 * User Registration tab
 *
 */
?>