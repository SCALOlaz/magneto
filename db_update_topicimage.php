<?php
/**
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('common');
if (!$auth->acl_get('a_'))
{
	trigger_error($user->lang['NOT_AUTHORISED']);
}
$message = '';
$error = false;
$sql_array = array();
$db->sql_return_on_error(true);
$db_tools = new phpbb_db_tools($db);
$db_tools->return_statements = true;

// SQL Statements
//---------------------------------------------------------------------------//
//$sql_array[] = 'ALTER TABLE ' . USERS_TABLE . " ADD user_skype varchar( 255 ) NOT NULL DEFAULT ''";
//$sql_array[] = 'ALTER TABLE ' . USERS_TABLE . " ADD user_skype_type tinyint( 1 ) DEFAULT '0' NOT NULL";
$sql_array[] = "INSERT INTO `phpbb_acl_options` (auth_option, is_global, is_local, founder_only) VALUES ('f_topic_image', 0, 1, 0)";
$sql_array[] = "INSERT INTO `phpbb_config` VALUES ('img_max_topic_image_width', 150, 0)";
$sql_array[] = "INSERT INTO `phpbb_config` VALUES ('img_max_topic_image_height', 100, 0)";
$sql_array[] = "ALTER TABLE `phpbb_attachments` ADD topic_image tinyint(1) UNSIGNED NOT NULL DEFAULT 0";
$sql_array[] = "ALTER TABLE `phpbb_forums` ADD forum_allow_topic_image TINYINT(1) NOT NULL DEFAULT 0";
$sql_array[] = "ALTER TABLE `phpbb_topics` ADD topic_image_id MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0";
$sql_array[] = "UPDATE phpbb_attachments SET topic_image = 1 WHERE in_message = 0 AND post_msg_id IN (SELECT topic_first_post_id FROM phpbb_topics WHERE topic_attachment = 1)";
//---------------------------------------------------------------------------//

// Language strings
$user->add_lang('install');
$user->lang['SQL_STATEMENT_SQL']     = $user->lang['SQL'];
$user->lang['SQL_STATEMENT_SUCCESS'] = $user->lang['DONE'];
$user->lang['SQL_STATEMENT_FAILURE'] = $user->lang['ERROR'];
$user->lang['SQL_RESULT_SUCCESS']	 = $user->lang['UPDATE_DB_SUCCESS'];
$user->lang['SQL_RESULT_FAILURE']	 = $user->lang['SOME_QUERIES_FAILED'];

// Begin executing SQL statements
foreach ($sql_array as $sql_query)
{
	$result = $db->sql_query($sql_query);
	$message .= '<span style="display:block;background-color:#FAFAFA;color:#333;font-family:\'Courier New\',monospace;padding-left:4px;padding-right:4px;"><span style="font-weight:bold;">' . $user->lang['SQL_STATEMENT_SQL'] . ': </span>' . $sql_query . '</span>';
	if ($result)
	{
		$message .= '<span style="color:green;font-weight:bold;">' . $user->lang['SQL_STATEMENT_SUCCESS'] . '!</span>';
	}
	else
	{
		$error = true;
		$db_error = $db->sql_error();
		$message .= '<span style="color:red;"><span style="font-weight:bold;">' . $user->lang['SQL_STATEMENT_FAILURE'] . ': </span>' . $db_error['message'] . '</span>';
	}
	$message .= '<br /><br />';
}

// Final result
if($error == true)
{
	$message = '<span style="color:red;">' . $user->lang['SQL_RESULT_FAILURE'] . '</span><br /><br />' . $message;
}
else
{
	$message .= '<span style="color:green;">' . $user->lang['SQL_RESULT_SUCCESS'] . '</span>';
}
trigger_error($message);

?>