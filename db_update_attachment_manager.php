<?php
/**
*
* @package phpBB3
* @version $Id: index.php,v 1.001 2008/02/09 14:48:28 rxu Exp $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('acp/common', 'acp/modules'));

// Did user forget to login? Give 'em a chance to here ...
if ($user->data['user_id'] == ANONYMOUS)
{
	login_box('', $user->lang['LOGIN_ADMIN'], $user->lang['LOGIN_ADMIN_SUCCESS'], false);
}

// Is user any type of admin? No, then stop here, each script needs to
// check specific permissions but this is a catchall
if (!$auth->acl_get('a_'))
{
	trigger_error('NO_ADMIN');
}

$result = array();
$result = module_install('manage_attachments', 'acp');

if($result['error'])
{
	trigger_error($result['error']);
}
elseif($result['result'])
{
	trigger_error($result['result']);
}

function module_install($module_name = '', $module_class = '')
{
	global $cache, $db, $phpbb_root_path, $phpEx, $user;

	if(empty($module_name) || empty($module_class))
	{
		return array('error' => $user->lang['NO_MODULE']);
	}
	
	if(!file_exists($phpbb_root_path . 'includes/acp/info/acp_' . $module_name . '.' . $phpEx))
	{
		return array('error' => $user->lang['NO_MODULE']);
	}
	
	require($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	require($phpbb_root_path . 'includes/functions_module.' . $phpEx);
	include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);

	$module = &new acp_modules();
	$module_info = $module_data = array();

	$module->module_class = $module_class;
	$parent_id = 0;
	$result = $error = '';

	$module_info = $module->get_module_infos($module_name, $module_class);

	if(sizeof($module_info))
	{
		
		foreach ($module_info as $module_basename => $fileinfo)
		{
			foreach ($fileinfo['modes'] as $module_mode => $row)
			{
				foreach ($row['cat'] as $cat_name)
				{
					$sql = 'SELECT module_id FROM ' . MODULES_TABLE . " WHERE module_langname = '$cat_name'";
					$result = $db->sql_query($sql);
					$parent_id = $db->sql_fetchfield('module_id');
					$db->sql_freeresult($result);
					if (!$parent_id)
					{
						continue;
					}

					$sql_module = 'SELECT module_id FROM ' . MODULES_TABLE . " WHERE module_basename = '$module_basename'";
					$result = $db->sql_query($sql_module);
					if($module_id = $db->sql_fetchfield('module_id'))
					{
						$module_data['module_id'] = $module_id;
					}
					$db->sql_freeresult($result);

					$module_data = array_merge($module_data, array(
						'module_basename'	=> $module_basename,
						'module_enabled'	=> 1,
						'module_display'	=> (isset($row['display'])) ? (int) $row['display'] : 1,
						'parent_id'			=> $parent_id,
						'module_class'		=> $module_class,
						'module_langname'	=> $row['title'],
						'module_mode'		=> $module_mode,
						'module_auth'		=> $row['auth'],
					));

					$module->update_module_data($module_data, true);

					// Check for last sql error happened
					if ($db->sql_error_triggered)
					{
						$error = $db->sql_error($db->sql_error_sql);
						trigger_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
					}
				}
			}
		}
		$cache->purge();
		$result = $user->lang['MODULE_ADDED'];
	}
	else
	{
		$error = $user->lang['NO_MODULE'];
	}
	
	return array(
			'error'			=> $error,
			'result'		=> $result,
			'module_name'	=> $module_name
			);
}

?>
