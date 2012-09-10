<?php
/**
 *
 * @author Garret_Dark (Александр Литвин) axel@mt80.ru
 * @version $Id$
 * @copyright (c) 2012 Axel aka Garret_Dark www.phpbbstyle.ru
* @license http://www.opensource.org/licenses/rpl1.5.txt Reciprocal Public License 1.5
 *
 */

/**
 * @ignore
 */
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();


if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'UFAQ';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'ufaq_version';


// The language file which will be included when installing
$language_file = 'mods/info_acp_ufaq';


/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
$logo_img = 'images/logo.png';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// First release 1.0.0
	'1.0.0' => array(

		'table_add' => array(
			array($table_prefix . 'ufaq_cats', array(
				'COLUMNS' => array(
					'cat_id' => array('INT:11', NULL, 'auto_increment'),
					'cat_name' => array('VCHAR:255', ''),
					'cat_count' => array('INT:11', 0),
					'last_question_id' => array('INT:11', 0),
					'last_question_name' => array('VCHAR:255', ''),
					'last_question_time' => array('INT:11', 0),
				),

				'PRIMARY_KEY'	=> 'cat_id',
				'KEY'			=> 'last_question_id',
			)),

			array($table_prefix . 'ufaq_questions', array(
				'COLUMNS' => array(
					'q_id' => array('INT:11', NULL, 'auto_increment'),
					'q_parent' => array('INT:11', 0),
					'q_parent_q' => array('INT:11', 0),
					'q_type' => array('INT:1', 0),
					'q_time' => array('INT:11', 0),
					'q_subj' => array('VCHAR:255', ''),
					'q_text' => array('TEXT', ''),
					'bbcode_uid' => array('VCHAR:25', ''),
					'bbcode_bitfield' => array('VCHAR:25', ''),
					'q_user_id' => array('INT:11', 0),
					'q_answers' => array('INT:11', 0),
					'q_views' => array('INT:11', 0),
					'q_rating' => array('INT:11', 0),
					'q_raters' => array('TEXT', ''),
				),

				'PRIMARY_KEY'	=> 'q_id',
				'KEY'			=> 'q_time',
			)),
		),

		'module_add' => array(
			// First, lets add a new category to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'UFAQ'),

			// next let's add our modules
			array('acp', 'UFAQ', array(
					'module_basename'	=> 'ufaq',
					'modes'				=> array('index'),
					'module_auth'		=> 'acl_a_',
				),
			),
		),

		'permission_add' => array(
			array('u_add_answers', true),
			array('u_add_question', true),
		),

		'permission_set' => array(
			// Global  permissions
			array('ROLE_USER_STANDARD', 'u_add_question', 'role', true),
			array('REGISTERED', 'u_add_lot', 'u_add_question', true),
		),

		'cache_purge' => array(
			array('template', 0),
			array('imageset', 0),
			array(),
		),

	),

    // Version 1.0.1
	'1.0.1' => array(

		'table_column_add' => array(
			array($table_prefix . 'ufaq_questions', 'q_watch', array('INT:1', 0)),
		),
	),

    // Version 1.0.2
	'1.0.2' => array(

		'table_column_add' => array(
			array($table_prefix . 'ufaq_cats', 'cat_img', array('VCHAR:255', '')),
		),
	),

    // Version 1.0.3
	'1.0.3' => array(

		'table_column_add' => array(
			array($table_prefix . 'ufaq_questions', 'q_users_watch', array('TEXT', '')),
		),
	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);;

/*
* Here is our custom function that will be called for version 0.9.1.
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/

?>