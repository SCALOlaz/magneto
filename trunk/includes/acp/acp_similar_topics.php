<?php
/**
* I'm request you retain the copyright notice below including the link to site author.
*
* @package acp
* @version $Id: acp_similar_topics.php, v 1.1.0 2010/11/21 01:10:26 Porutchik Exp $
* @copyright (c) 2008-2010 Sergey aka Porutchik, http://forum.aeroion.ru
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package acp
*/
class acp_similar_topics
{
	var $u_action;
	var $class_name;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		if ($mode != 'similar_topics')
		{
			return;
		}
		
		$this->class_name	= get_class($this);
		$this->tpl_name		= $this->class_name;
		$this->page_title	= 'ACP_SIMILAR_TOPICS';
		$this->new_config	= $config;

		$action	= request_var('action', '', true);
		$submit	= (isset($_POST['submit'])) ? true : false;
		$cfg_array = utf8_normalize_nfc(request_var('config', array('' => ''), true));
		$mark_ignored_forum = request_var('mark_ignored_forum', array(0), true);
		$mark_noshow_forum = request_var('mark_noshow_forum', array(0), true);

		$form_key = $this->class_name;
		add_form_key($form_key);

		$lang_info_path = 'mods/info_acp_similar_topics';
		$user->add_lang($lang_info_path);
		
		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
		$display_vars = array(
			'title'	=> $this->page_title,
			'lang'	=> $lang_info_path,
			'legend_settings'	=> 'SETTINGS',
			
			'vars'	=> array(
				'similar_topics_sort_type'				=> array('lang' => 'SIMILAR_SORT_TYPE',			'validate' => 'string',	'type' => 'select', 'method' => 'similar_sort_type', 'explain' => true),
				'similar_topics_stopwords'				=> array('lang' => 'SIMILAR_STOPWORDS',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'similar_topics_use_cache'				=> array('lang' => 'SIMILAR_USE_CACHE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'similar_topics_cache_time'				=> array('lang' => 'SIMILAR_USE_CACHE_TIME',	'validate' => 'int:0',	'type' => 'text:7:6', 'explain' => true),
				'similar_topics_boolean_mode'			=> array('lang' => 'SIMILAR_USE_BOOLEAN_MODE',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'similar_topics_min_relevance'			=> array('lang' => 'SIMILAR_MIN_RELEVANCE',		'validate' => 'real:0',	'type' => 'text:5:4', 'explain' => true),
				'similar_topics_posting'				=> array('lang' => 'SIMILAR_POSTING',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
				'similar_topics_viewtopic'				=> array('lang' => 'SIMILAR_VIEWTOPIC',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
				'similar_topics_max_topics'				=> array('lang' => 'SIMILAR_MAX_TOPICS',		'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true),
				'similar_topics_min_amount_words_viewtopic'	=> array('lang' => 'SIMILAR_MIN_AMOUNT_WORDS_VIEWTOPIC',	'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true),
				'similar_topics_min_amount_words_posting'	=> array('lang' => 'SIMILAR_MIN_AMOUNT_WORDS_POSTING',	'validate' => 'int:0',	'type' => 'text:5:4', 'explain' => true),
			),
		);

		if (!sizeof($cfg_array))
		{
			$cfg_array = $this->new_config;
		}
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}
			$this->new_config[$config_name] = $cfg_array[$config_name];
		}

		if ($submit)
		{
			add_log('admin', 'LOG_CONFIG_' . strtoupper($mode));
			
			set_config('similar_topics_use_cache',		$this->new_config['similar_topics_use_cache']);
			set_config('similar_topics_cache_time',		$this->new_config['similar_topics_cache_time']);
			set_config('similar_topics_boolean_mode',	$this->new_config['similar_topics_boolean_mode']);
			set_config('similar_topics_stopwords',		$this->new_config['similar_topics_stopwords']);
			set_config('similar_topics_sort_type',		$this->new_config['similar_topics_sort_type']);
			set_config('similar_topics_max_topics',		$this->new_config['similar_topics_max_topics']);
			set_config('similar_topics_posting',		$this->new_config['similar_topics_posting']);
			set_config('similar_topics_viewtopic',		$this->new_config['similar_topics_viewtopic']);
			set_config('similar_topics_min_relevance',	$this->new_config['similar_topics_min_relevance']);
			set_config('similar_topics_min_amount_words_viewtopic', $this->new_config['similar_topics_min_amount_words_viewtopic']);
			set_config('similar_topics_min_amount_words_posting', $this->new_config['similar_topics_min_amount_words_posting']);

			set_config('similar_topics_ignore_forums_ids', (sizeof($mark_ignored_forum)) ? implode("\n", $mark_ignored_forum) : '');
			set_config('similar_topics_noshow_forums_ids', (sizeof($mark_noshow_forum)) ? implode("\n", $mark_noshow_forum) : '');

			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		if (isset($config['similar_topics_version']))
		{
			$mod_version = $config['similar_topics_version'];
		}
		else
		{
			if (!class_exists('acp_modules'))
			{
				include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
			}
			$acp_modules = new acp_modules();
			// Get module information
			$module_infos = $acp_modules->get_module_infos($id, 'acp');
			$mod_version = $module_infos[$id]['version'];
		}

		$template->assign_vars(array(
			'S_ERROR'						=> (sizeof($error)) ? true : false,
			'ERROR_MSG'						=> implode('<br />', $error),
			'ACP_SIMILAR_TOPICS_MOD_VERSION'=> $mod_version,

			'U_ACTION'						=> $this->u_action)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
				)
			);
		
			unset($display_vars['vars'][$config_key]);
		}

		$ignore_forums = explode("\n", trim($this->new_config['similar_topics_ignore_forums_ids']));
		$noshow_forums = explode("\n", trim($this->new_config['similar_topics_noshow_forums_ids']));
		
		$forum_list = $this->get_forum_list();
		foreach ($forum_list as $forum_id => $row)
		{
			if ($row['forum_status'] == ITEM_LOCKED)
			{
				$folder_image = '<img src="images/icon_folder_lock.gif" alt="' . $user->lang['FORUM_LOCKED'] . '" />';
			}
			else
			{
				$folder_image = '<img src="images/icon_folder.gif" alt="' . $user->lang['FOLDER'] . '" />';
			}
			$template->assign_block_vars('forums', array(
				'FOLDER_IMAGE'			=> $folder_image,
				'FORUM_NAME'			=> $row['forum_name'],
				'FORUM_DESCRIPTION'		=> generate_text_for_display($row['forum_desc'], $row['forum_desc_uid'], $row['forum_desc_bitfield'], $row['forum_desc_options']),
				'FORUM_ID'				=> $row['forum_id'],
				'CHECKED_IGNORE_FORUM'	=> (in_array($row['forum_id'], $ignore_forums)) ? ' checked' : '',
				'CHECKED_NOSHOW_FORUM'	=> (in_array($row['forum_id'], $noshow_forums)) ? ' checked' : '',
				'CAT_NAME'				=> (!empty($row['parent_id'])) ? $row['cat_name'] : '',
				'U_FORUM'				=> "{$phpbb_root_path}viewforum.$phpEx?f=" . $row['forum_id'],
			));
		}

	}

	/**
	* Similar sort type
	*/
	function similar_sort_type($value, $key = '')
	{
		global $user;
		
		$options_ary = array('time' => 'SIMILAR_SORT_DATE', 'relev' => 'SIMILAR_SORT_RELEV');
		$similar_sort_type_options = '';
		foreach ($options_ary as $key_value=>$option)
		{
			$selected = ($value == $key_value) ? ' selected="selected"' : '';
			$similar_sort_type_options .= '<option value="' . $key_value . '"' . $selected . '>' . $user->lang[$option] . '</option>';
		}
		return $similar_sort_type_options;
	}
	
	/**
	* Get forums list
	*/
	function get_forum_list()
	{
		global $db;
		
		$sql = 'SELECT f.forum_id, f.forum_name, f.forum_desc, f.forum_desc_uid, f.forum_desc_bitfield, 
				f.forum_desc_options, f.parent_id, f.forum_status, c.forum_name AS cat_name
			FROM ' . FORUMS_TABLE . ' AS f, ' . FORUMS_TABLE . ' AS c 
			WHERE (c.forum_id = f.parent_id OR f.parent_id = 0) 
				AND f.forum_type = ' .	FORUM_POST . '
			GROUP BY f.forum_id
			ORDER BY f.left_id ASC';
		$result = $db->sql_query($sql);
		$forum_list = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		
		return $forum_list;
	}

}

?>