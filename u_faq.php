<?php
/**
*
* @package phpBB User FAQ
* @version $Id: u_faq.php,v 1.0.2 2012/08/4 03:44:00 Garret_Dark Exp $
* @copyright (c) 2012 Axel aka Garret_Dark ( http://www.phpbbstyle.ru/ )
* @license http://www.opensource.org/licenses/rpl1.5.txt Reciprocal Public License 1.5
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
include($phpbb_root_path . 'includes/trim_message/trim_message.' . $phpEx);
include($phpbb_root_path . 'includes/trim_message/bbcodes.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/info_acp_ufaq');

$mode = request_var('mode', '');
$id = (int) request_var('id', 0);
$user_id = $user->data['user_id'];
$ufaq_enable = $config['ufaq_enable'];

// Хлебные крошки
$template->assign_vars(array(
	'UFAQ_ENABLE'	=> $ufaq_enable,
)
);

if ($ufaq_enable)	// UFAQ_ENABLE_BEGIN
{
	$ufaq_use_rating = $config['ufaq_use_rating'];
	$ufaq_use_watching = $config['ufaq_use_watching'];
	
	if ($mode && ( 
				( $mode == 'add_q' || $mode == 'save_q' || $mode == 'add_a' || $mode == 'save' || $mode == 'del' )
				&& 
				( !$auth->acl_get('u_add_question') && !$auth->acl_get('u_add_answers') )
				)
	)
	{
		login_box('', $user->lang['LOGIN']);
	}

	// Хлебные крошки
	$template->assign_block_vars('navlinks',array(
		'FORUM_NAME'		=> $user->lang['UFAQ'],
		'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx"),
	)
	);
	$cat_count = $quest_count = $answers_count = 0;
	$sql = "SELECT COUNT(cat_id) AS cat_count FROM " . Q_CATS_TABLE . " q";
		$result = $db->sql_query($sql);
		$cat_count = (int) $db->sql_fetchfield('cat_count');
		$db->sql_freeresult($result);	
	$sql = "SELECT COUNT(q_id) AS quest_count FROM " . Q_QUESTION_TABLE . " q WHERE q.q_type = 1";
		$result = $db->sql_query($sql);
		$quest_count = (int) $db->sql_fetchfield('quest_count');
		$db->sql_freeresult($result);
	$sql = "SELECT COUNT(q_id) AS answers_count FROM " . Q_QUESTION_TABLE . " q WHERE q.q_type = 0";
		$result = $db->sql_query($sql);
		$answers_count = (int) $db->sql_fetchfield('answers_count');
		$db->sql_freeresult($result);
		
	$template->assign_vars(array(
	'U_FSEARCH_TOP'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=search_top'),
	'U_FSEARCH_NEW'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=search_new'),
	'U_FSEARCH_ANSWERED'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=search_answered'),

	'UFAQ_CATS_COUNT'	=> $cat_count,
	'UFAQ_QUESTIONS_COUNT'	=> $quest_count,
	'UFAQ_ANSWERS_COUNT'	=> $answers_count,
	)
	);

	$sql = 'SELECT cat_id, cat_name
			FROM ' . Q_CATS_TABLE . '
			ORDER BY cat_name ASC';
			$result = $db->sql_query($sql);
			$cat_mod = '';	//'<option selected ></option>';
			$cat_mod_limiter = 19;
			while($row = $db->sql_fetchrow($result))
			{
				$cat_mod .= '<option value="cat_'.$row['cat_id'].'">' . ( utf8_strlen($row['cat_name']) > $cat_mod_limiter + 3 ? utf8_substr($row['cat_name'], 0, $cat_mod_limiter) . '...' : $row['cat_name'] ) . '</option>';
			}
			$db->sql_freeresult($result);	
	
if(!$mode)
{
	$sql = 'SELECT *
			FROM ' . Q_CATS_TABLE . '
			ORDER BY cat_name ASC, cat_id ASC';
			$result = $db->sql_query($sql);

			while($row = $db->sql_fetchrow($result))
			{
					$qu_user = $an_user = $an_time = $an_id = $qu_text = $an_text = '';
					
				    $sql_a = 'SELECT u.username, u.user_colour, q.*
							FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
							WHERE q.q_parent = " . $row['cat_id'] . "
							AND q.q_type = 1
							AND u.user_id = q.q_user_id
							ORDER BY q.q_time DESC LIMIT 1";
							$result_a = $db->sql_query($sql_a);

							while($qa = $db->sql_fetchrow($result_a))
							{
							// Last Question Author
								$qu_user = get_username_string('full', $qa['q_user_id'], $qa['username'], $qa['user_colour']);
								$qu_text = ufaq_make_message_len($qa['q_text'], $qa['bbcode_uid'], $qa['bbcode_bitfield']);
								$qu_user_id = $qa['q_user_id'];
								$qu_fakenick = ($qa['q_user_id'] == ANONYMOUS && isset($qa['q_subj_author'])) || (isset($qa['q_subj_author']) && $qa['q_user_hidenick'] != 0) ? $qa['q_subj_author'] : '';
								$qu_hidenick = $qa['q_user_hidenick'] != 0 ? true : false;
							}		
							$db->sql_freeresult($result_a);

					$sql_cn = "SELECT COUNT(q_id) AS cn_count
							FROM " . Q_QUESTION_TABLE . " q
							WHERE q.q_parent_q = " . $row['last_question_id'] . "
							AND q.q_type = 0";
						$result_cn = $db->sql_query($sql_cn);
						$an_count = (int) $db->sql_fetchfield('cn_count');
						$db->sql_freeresult($result_cn);

				    $sql_qa = 'SELECT u.username, u.user_colour, q.*
							FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
							WHERE q.q_parent_q = " . $row['last_question_id'] . "
							AND q.q_type = 0
							AND u.user_id = q.q_user_id
							ORDER BY q_time DESC LIMIT 1";
							$result_qa = $db->sql_query($sql_qa);

							while($qa = $db->sql_fetchrow($result_qa))
							{
								$an_fakenick = $qa['q_user_id'] == ANONYMOUS && isset($qa['q_subj_author']) ? $qa['q_subj_author'] : '';
								
								$an_user = get_username_string('full', $qa['q_user_id'], $qa['username'], $qa['user_colour']);
								$an_time = $qa['q_time'];
								$an_id = $qa['q_id'];
								$an_text = $user->format_date($an_time) . "<br />" /*. ($an_fakenick != '' ? $an_fakenick : $an_user) . "<br />" */. ufaq_make_message_len($qa['q_text'], $qa['bbcode_uid'], $qa['bbcode_bitfield']);
							}		
							$db->sql_freeresult($result_qa);

				$template->assign_block_vars('cats',array(
					'TITLE'		=> $row['cat_name'],
					'COUNT'		=> $row['cat_count'],
					'CAT_IMG'		=> $row['cat_img'] ? $phpbb_root_path.'images/ufaq/'.$row['cat_img'] : '',
					'LAST_Q'	=> $row['last_question_name'],
					'U_LAST_Q'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$row['last_question_id']),
					'U_CAT'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$row['cat_id']),
					'QUESTER_USER' => $qu_user,
					'QUESTER_TIME' => $user->format_date($row['last_question_time']),
					'QUESTION_TEXT'	=> $qu_text,
					
					// Last Answer block
					'ANSWERS'	=> $an_count,
					'ANSWER_ID'	=> $an_id,
					'ANSWER_USER' => $an_user,
					'ANSWER_TIME' => $user->format_date($an_time),
					'ANSWER_TEXT'	=> $an_text,
					
					'QUESTOR_FAKENICK'	=> $qu_fakenick,
					'QUESTOR_HIDENICK'	=> $qu_hidenick,
					'VIEW_RIGHTS'	=> ($user_id != ANONYMOUS && $qu_user_id == $user_id) || $auth->acl_get('m_') || $auth->acl_get('a_') ? true : false,
					'POSTER_FAKENICK'	=> $an_fakenick,
				)
				);
			}
			$db->sql_freeresult($result);

	$template->assign_vars(array(
	'S_INDEX'	=> true,
	//'MINI_POST_IMG'			=> $user->img('icon_post_target', 'POST'),
	)
	);

	// Output page
	page_header($user->lang['UFAQ']);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);

}
elseif($mode == 'cat' && $id)
{	$sql = 'SELECT cat_name, cat_count, cat_img, cat_users_watch
			FROM ' . Q_CATS_TABLE . '
			WHERE cat_id = '.$id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

	if(!$row['cat_name'])
	{		trigger_error($user->lang['UFAQ_NO_CAT']);	}
    $cat_name = $row['cat_name'];
    $cat_count = $row['cat_count'];
	$cat_img = $row['cat_img'] ? $phpbb_root_path.'images/ufaq/'.$row['cat_img'] : '';
	$cat_watchers = $row['cat_users_watch'];
	// Хлебные крошки
	$template->assign_block_vars('navlinks',array(
		'FORUM_NAME'		=> $cat_name,
		'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id),
	)
	);

	$sort = (int) request_var('sort', 0);
	$s1 = $s2 = '';
	if(!$sort)
	{
		$order_by = 'q.q_time DESC';
	}
	elseif($sort == 1)
	{
		$order_by = 'q.q_answers DESC, q.q_time DESC';
		$s1 = 1;
	}
	elseif($sort == 11)
	{
		$order_by = 'q.q_answers ASC, q.q_time ASC';
	}
	elseif($sort == 2 && $ufaq_use_rating)
	{
		$order_by = 'q.q_rating DESC, q.q_time DESC';
		$s2 = 2;
	}
	elseif($sort == 22 && $ufaq_use_rating)
	{
		$order_by = 'q.q_rating ASC, q.q_time ASC';
	}

$start   = request_var('start', 0);
$limit   = 25;
$pagination_url = append_sid($phpbb_root_path . 'u_faq.' . $phpEx, 'mode=cat&amp;id='.$id);

$an_user = $an_time = $an_id = $an_text = '';

    $sql = 'SELECT u.username, u.user_colour, q.*
			FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
			WHERE q.q_parent = $id
			AND q.q_type = 1
			AND u.user_id = q.q_user_id
			ORDER BY $order_by";
			$result = $db->sql_query_limit($sql, $limit, $start);

			while($row = $db->sql_fetchrow($result))
			{
				    $sql_c = 'SELECT u.username, u.user_colour, q.*
							FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
							WHERE q_parent_q = " . $row['q_id'] . "
							AND q_type = 0
							AND u.user_id = q.q_user_id
							ORDER BY q_time DESC LIMIT 1";
							$result_c = $db->sql_query($sql_c);

							while($q = $db->sql_fetchrow($result_c))
							{
								$an_user = get_username_string('full', $q['q_user_id'], $q['username'], $q['user_colour']);
								$an_time = $q['q_time'];
								$an_id = $q['q_id'];
								$an_text = ufaq_make_message_len($q['q_text'], $q['bbcode_uid'], $q['bbcode_bitfield']);
								
								$an_fakenick = ($q['q_user_id'] == ANONYMOUS && isset($q['q_subj_author'])) || (isset($q['q_subj_author']) && $q['q_user_hidenick'] != 0) ? $q['q_subj_author'] : '';
							}		
							$db->sql_freeresult($result_c);
							
				$template->assign_block_vars('q',array(
					'SUBJ'		=> $row['q_subj'],
					'QUESTION_TEXT'	=> ufaq_make_message_len($row['q_text'], $row['bbcode_uid'], $row['bbcode_bitfield']),
					'ANSWERS'	=> $row['q_answers'],
					'RATING'	=> $row['q_rating'],
					'RATING_USE'	=> $ufaq_use_rating,
					'VIEWS'		=> $row['q_views'],
					'TIME'		=> $user->format_date($row['q_time']),
					'QUESTOR'	=> get_username_string('full', $row['q_user_id'], $row['username'], $row['user_colour']),
					'U_QUESTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$row['q_id']),
					// Last Answer data
					'ANSWER_ID'	=> $an_id,
					'ANSWER_USER' => $an_user,
					'ANSWER_TIME' => $user->format_date($an_time),
					'ANSWER_TEXT'	=> $an_text,
					
					'S_MODE'	=> $row['q_mode'],

					'QUESTOR_FAKENICK'	=> ($row['q_user_id'] == ANONYMOUS && isset($row['q_subj_author'])) || (isset($row['q_subj_author']) && $row['q_user_hidenick'] != 0) ? $row['q_subj_author'] : '',
					'QUESTOR_HIDENICK'	=> $row['q_user_hidenick'] != 0 ? true : false,
					'VIEW_RIGHTS'	=> ($user_id != ANONYMOUS && $row['q_user_id'] == $user_id) || $auth->acl_get('m_') || $auth->acl_get('a_') ? true : false,
					'ANSWER_FAKENICK'	=> $an_fakenick,
				)
				);
			}
			$db->sql_freeresult($result);

	$template->assign_vars(array(
	'S_LIST_Q'	=> true,
	'PARENT'	=> $cat_name,
	'ADD_QUEST_IMG' 	=> $user->img('button_question_new', 'UFAQ_ADD_QUEST'),
	'S_CAN_QUEST'		=> $auth->acl_get('u_add_question') ? $user->lang['UFAQ_CAN_QUEST'] : $user->lang['UFAQ_CANT_QUEST'],
	'S_CAN_ANSWER'		=> $auth->acl_get('u_add_answers') ? $user->lang['UFAQ_CAN_ANSWER'] : $user->lang['UFAQ_CANT_ANSWER'],

	'S_CAN_WATCH_CAT'	=> $ufaq_use_watching && !$user->data['is_bot'] && !in_array($user_id, explode(",",$cat_watchers)) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=catw&amp;id='.$id) : '',
	'S_CAN_UNWATCH_CAT'	=> $ufaq_use_watching && !$user->data['is_bot'] && in_array($user_id, explode(",",$cat_watchers)) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=catunw&amp;id='.$id) : '',
	
	'PAGE_NUMBER'       => on_page($cat_count, $limit, $start),
	'U_ADD_QUEST'		=> $auth->acl_get('u_add_question') ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=add_q&amp;id='.$id) : '',
	'U_SORT_ANSWERS'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id.'&amp;sort=1'.$s1),
	'U_SORT_RATING'		=> $ufaq_use_rating ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id.'&amp;sort=2'.$s2) : '',
	'U_ADD_REVIEW'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=add&amp;id='.$id),
	'PAGINATION'        => generate_pagination($pagination_url, $cat_count, $limit, $start),
	'S_SEARCHBOX_ACTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=search&amp;id='.$id),
	'CAT_IMG'			=> $cat_img,
	
	'RATING_USE'		=> $ufaq_use_rating,
	'WATCHING_USE'		=> $ufaq_use_watching,
	)
	);

	// Output page
	page_header($cat_name);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);}
elseif($mode == 'search' || $mode == 'search_new' || $mode == 'search_top' || $mode == 'search_answered')
{
	$string = utf8_normalize_nfc(request_var('search', '', true));

	if(!$string && $mode == 'search')
	{
		trigger_error($user->lang['UFAQ_NO_RESULT']);
	}

	if(utf8_strlen($string) < 4 && $mode == 'search')
	{
		trigger_error($user->lang['UFAQ_NO_RESULT']);
	}

	$string2 = utf8_strtolower($string);
	$string3 = utf8_ucfirst($string);

$start   = request_var('start', 0);
$limit   = 25;

$an_user = $an_time = $an_id = $an_text = '';

	if($mode == 'search')
	{		$pagination_url = append_sid($phpbb_root_path . 'u_faq.' . $phpEx, 'mode='.$mode.'&amp;id='.$id.'&amp;search='.$string);
    $sql = 'SELECT u.username, u.user_colour, q.*
			FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
			WHERE q.q_type = 1
			AND u.user_id = q.q_user_id
			AND (q.q_subj LIKE '%$string%'
				OR q.q_text LIKE '%$string%'
				OR q.q_subj LIKE '%$string2%'
				OR q.q_text LIKE '%$string2%'
				OR q.q_subj LIKE '%$string3%'
				OR q.q_text LIKE '%$string3%')
			ORDER BY q.q_rating DESC, q.q_time ASC";
			$result = $db->sql_query_limit($sql, $limit, $start);


		$sql_c = 'SELECT COUNT(q_id) AS q_count
		        FROM ' . Q_QUESTION_TABLE . "
			WHERE q_type = 1
			AND (q_subj LIKE '%$string%'
				OR q_text LIKE '%$string%'
				OR q_subj LIKE '%$string2%'
				OR q_text LIKE '%$string2%'
				OR q_subj LIKE '%$string3%'
				OR q_text LIKE '%$string3%')
			ORDER BY q_rating DESC, q_time ASC";
			$result_c = $db->sql_query($sql_c);
			$q_count = (int) $db->sql_fetchfield('q_count');
			$db->sql_freeresult($result_c);
    }
    else
    {    	$pagination_url = append_sid($phpbb_root_path . 'u_faq.' . $phpEx, 'mode='.$mode);
    	if($mode == 'search_new')
    	{    		$where = 'AND q.q_answers = 0 ORDER BY q.q_time DESC, q.q_rating DESC';    	}
    	else if($mode == 'search_answered')
    	{
    		$where = 'AND q.q_answers != 0 ORDER BY q.q_answers DESC, q.q_time DESC, q.q_rating DESC';
    	}
    	else
    	{    		$where = 'AND q.q_rating >0 ORDER BY q.q_answers DESC, q.q_rating DESC, q.q_time DESC';    	}

		$sql_c = 'SELECT COUNT(q_id) AS q_count
		        FROM ' . Q_QUESTION_TABLE . " q
				WHERE q_type = 1
				$where";
			$result_c = $db->sql_query($sql_c);
			$q_count = (int) $db->sql_fetchfield('q_count');
			$db->sql_freeresult($result_c);

    	$sql = 'SELECT u.username, u.user_colour, q.*
			FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
			WHERE q.q_type = 1
			AND u.user_id = q.q_user_id
			$where";
			$result = $db->sql_query_limit($sql, $limit, $start);    }
			while($row = $db->sql_fetchrow($result))
			{
				$sql_ca = 'SELECT u.username, u.user_colour, q.*
					FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
					WHERE q_parent_q = " . $row['q_id'] . "
					AND q_type = 0
					AND u.user_id = q.q_user_id
					ORDER BY q_time DESC LIMIT 1";
					$result_ca = $db->sql_query($sql_ca);

					while($q = $db->sql_fetchrow($result_ca))
					{
						$an_user = get_username_string('full', $q['q_user_id'], $q['username'], $q['user_colour']);	//$q['q_user_id'];
						$an_time = $q['q_time'];
						$an_id = $q['q_id'];
						$an_text = ufaq_make_message_len($q['q_text'], $q['bbcode_uid'], $q['bbcode_bitfield']);
						
						$an_fakenick = ($q['q_user_id'] == ANONYMOUS && isset($q['q_subj_author'])) || (isset($q['q_subj_author']) && $q['q_user_hidenick'] != 0) ? $q['q_subj_author'] : '';
					}		
					$db->sql_freeresult($result_ca);

					$sql_se = 'SELECT cat_id, cat_name, cat_img
							FROM ' . Q_CATS_TABLE . '
							WHERE cat_id = "' . $row['q_parent'] . '"';
							$result_se = $db->sql_query($sql_se);
							$row_se = $db->sql_fetchrow($result_se);
							$db->sql_freeresult($result_se);
					$cat_name = $row_se['cat_name'] ? $row_se['cat_name'] : '';
					//$cat_count = $row['cat_count'];
					$cat_img = $row_se['cat_img'] ? $phpbb_root_path.'images/ufaq/'.$row_se['cat_img'] : '';
					$cat_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$row_se['cat_id']);
					
				$template->assign_block_vars('q',array(
					'SUBJ'		=> $row['q_subj'],
					'QUESTION_TEXT'	=> ufaq_make_message_len($row['q_text'], $row['bbcode_uid'], $row['bbcode_bitfield']),
					'ANSWERS'	=> $row['q_answers'],
					'RATING'	=> $row['q_rating'],
					'RATING_USE'	=> $ufaq_use_rating,
					'VIEWS'		=> $row['q_views'],
					'TIME'		=> $user->format_date($row['q_time']),
					'QUESTOR'	=> get_username_string('full', $row['q_user_id'], $row['username'], $row['user_colour']),
					'U_QUESTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$row['q_id']),
										// Last Answer data					
					'ANSWER_ID'	=> $an_id,
					'ANSWER_USER' => $an_user,					
					'ANSWER_TIME' => $user->format_date($an_time),
					'ANSWER_TEXT'	=> $an_text,
					
					'CAT_IMG'		=> $cat_img,
					'PARENT'	=> $cat_name,
					'U_CAT_URL'	=> $cat_url,
					
					'QUESTOR_FAKENICK'	=> ($row['q_user_id'] == ANONYMOUS && $row['q_subj_author'] != '') || (isset($row['q_subj_author']) && $row['q_user_hidenick'] != 0) ? $row['q_subj_author'] : '',
					'QUESTOR_HIDENICK'	=> $row['q_user_hidenick'] != 0 ? true : false,
					'VIEW_RIGHTS'	=> $row['q_user_id'] == $user_id || $auth->acl_get('m_') || $auth->acl_get('a_') ? true : false,
					'ANSWER_FAKENICK'	=> $an_fakenick,
				)
				);
			}
			$db->sql_freeresult($result);

	$template->assign_vars(array(
	'S_LIST_Q'	=> true,
	'ADD_QUEST_IMG' 	=> $user->img('button_question_new', 'UFAQ_ADD_QUEST'),
	'S_CAN_QUEST'		=> $auth->acl_get('u_add_question') ? $user->lang['UFAQ_CAN_QUEST'] : $user->lang['UFAQ_CANT_QUEST'],
	'S_CAN_ANSWER'		=> $auth->acl_get('u_add_answers') ? $user->lang['UFAQ_CAN_ANSWER'] : $user->lang['UFAQ_CANT_ANSWER'],
	'PAGE_NUMBER'       => on_page($q_count, $limit, $start),
	'U_ADD_QUEST'		=> $auth->acl_get('u_add_question') ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=add_q&amp;id='.$id) : '',
	'U_ADD_REVIEW'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=add&amp;id='.$id),
	'PAGINATION'        => generate_pagination($pagination_url, $q_count, $limit, $start),
	'S_SEARCHBOX_ACTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=search&amp;id='.$id),
	'HIDDEN'	=>	$string,
	
	'SEARCH' 	=> true,
	'RATING_USE'	=> $ufaq_use_rating,
	)
	);

	// Output page
	page_header($user->lang['SEARCH']);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);
}
elseif($mode == 'q' && $id)
{
    $q = $raters_pl = $raters_mi = '';

    $sql = 'SELECT 
			u.*, q.*
			FROM ' . USERS_TABLE . ' u, ' . Q_QUESTION_TABLE . " q
			WHERE (q.q_parent_q = $id
			OR q.q_id = $id)
			AND u.user_id = q.q_user_id
			ORDER BY q.q_type DESC, q.q_time ASC";		// SORTING - q.q_rating DESC,  (DESC)
			$result = $db->sql_query($sql);
			
			$result_count = 0;
			while($row = $db->sql_fetchrow($result))
			{
				if($row['q_type'] == '1')
				{					$q = $row;
					$mode = $row['q_mode'];
				}
				else
				{
					$result_count ++;					$raters_pl = explode(",",$row['q_raters']);	// Raters PLUS
					$raters_mi = explode(",",$row['q_raters_minus']);	// Raters MINUS
					
					$answer_color = 0;
					if ($row['q_rating'] < 0)
					{
						$answer_color = 0.90 - ( abs($row['q_rating']) / 90);
						if ($answer_color <= 0.15) $answer_color = 0.15;						
					}
				
				//	if ( $row['q_user_id'] != ANONYMOUS && $row['q_subj_author'] == '' && $row['q_user_hidenick']
					if ( ($row['q_subj_author'] && $row['q_user_id'] == ANONYMOUS) || $row['q_user_hidenick'] )
					{
						$quoted_username = get_username_string('username', 0, $row['q_subj_author'], '#ffffff');
						$quoted_user_color = get_username_string('colour', 0, $row['q_subj_author'], '#ffffff');
					}
					else
					{
						$quoted_username = get_username_string('username', $row['q_user_id'], $row['username'], $row['user_colour']);
						$quoted_user_color = get_username_string('colour', $row['q_user_id'], $row['username'], $row['user_colour']);
					}
				
					$template->assign_block_vars('answers',array(
						'AVATAR'	=>  $config['ufaq_avatar_answers'] ? ($user->optionget('viewavatars') ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 20, 20) : '') : '',
						'U_USER'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u='.$row['q_user_id']),
						'RATING'	=> $row['q_rating'],
						'COLOR'	=> $answer_color,
						'ID'	=> $row['q_id'],
						'TEXT'	=> censor_text(generate_text_for_display($row['q_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], 7)),
						'TIME'		=> $user->format_date($row['q_time']),
						'USER'	=> get_username_string('full', $row['q_user_id'], $row['username'], $row['user_colour']),
						'U_QUESTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$row['q_id']),
						'U_EDIT'	=> ($auth->acl_get('u_add_answers') && $user->data['user_id'] == $row['q_user_id'] && $mode != 9) || ($auth->acl_get('m_') && $auth->acl_get('u_add_answers') && $mode != 9) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=edit&amp;id='.$row['q_id']) : '',
						'U_DEL'	=> ($auth->acl_get('u_add_answers') && $user->data['user_id'] == $row['q_user_id'] && !$row['q_answers']) || ($auth->acl_get('m_') && $auth->acl_get('u_add_answers')) || $auth->acl_get('a_') ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=del&amp;id='.$row['q_id']) : '',

						'U_RATE_PLUS'	=> $mode == 0 && $user_id != $row['q_user_id'] && !in_array($user_id, $raters_pl) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=rate&amp;id='.$row['q_id']) : '',
						'U_RATE_MINUS'	=> $mode == 0 && $user_id != $row['q_user_id'] && !in_array($user_id, $raters_mi) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=unrate&amp;id='.$row['q_id']) : '',
						'RATING_USE'	=> $ufaq_use_rating,
						
						'U_LINK'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$q['q_id']),
						'MINI_POST_IMG'			=> $user->img('icon_post_target', 'POST'),
						
						'POSTER_IP'		=> ($auth->acl_get('m_') || $auth->acl_get('a_')) && isset($row['q_user_ip']) ? $row['q_user_ip'] : '',
					//	'POSTER_HIDENICK'	=> $row['q_user_id'] != ANONYMOUS && $row['q_user_hidenick'] != 0 /*&& ($auth->acl_get('m_') || $auth->acl_get('a_'))*/ ? true : false,
						'VIEW_RIGHTS'	=> ($user_id != ANONYMOUS && $row['q_user_id'] == $user_id) || $auth->acl_get('m_') || $auth->acl_get('a_') ? true : false,
						'POSTER_FAKENICK'	=> isset($row['q_subj_author']) || (isset($row['q_subj_author']) && $row['q_user_hidenick'] != 0) ? $row['q_subj_author'] : '',
						'POSTER_HIDENICK'	=> $row['q_user_hidenick'] != 0 ? true : false,

						'POST_AUTHOR_COLOUR'	=> $quoted_user_color,
						'POSTER_QUOTE'		=> $quoted_username ? addslashes($quoted_username) : addslashes($row['q_subj_author'] ? $row['q_subj_author'] : ANONYMOUS),
						'S_QUOTE'	=> $auth->acl_get('u_add_answers') && $mode == 0 ? true : false,
						'S_QUICK_REPLY'		=> true,
					)
					);				}
			}
			$db->sql_freeresult($result);

	if(!$q)
	{
		trigger_error($user->lang['UFAQ_NO_QUEST']);
	}
	$user->setup('posting');
	$sql = 'SELECT cat_id, cat_name, cat_count
			FROM ' . Q_CATS_TABLE . '
			WHERE cat_id = '.$q['q_parent'];
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

	if(!$row['cat_name'])
	{
		trigger_error($user->lang['UFAQ_NO_CAT']);
	}

	// Хлебные крошки
	$template->assign_block_vars('navlinks',array(
		'FORUM_NAME'		=> $row['cat_name'],
		'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$row['cat_id']),
	)
	);
	get_user_rank($q['user_rank'], $q['user_posts'], $q['rank_title'], $q['rank_image'], $q['rank_image_src']);
	$q_user_email = ((!empty($q['user_allow_viewemail']) || $auth->acl_get('a_email')) && ($q['user_email'] != '')) ? ($config['board_email_form'] && $config['email_enable']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=email&amp;u=".$q['user_id']) : (($config['board_hide_emails'] && !$auth->acl_get('a_email')) ? '' : 'mailto:' . $q['user_email']) : '';
	$q_user_msnm = ($q['user_msnm'] && $auth->acl_get('u_sendim')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=msnm&amp;u=".$q['user_id']) : '';
	$q_user_icq = (!empty($q['user_icq'])) ? 'http://www.icq.com/people/webmsg.php?to=' . $q['user_icq'] : '';
	$q_user_icq_status_img = (!empty($q['user_icq'])) ? '<img src="http://web.icq.com/whitepages/online?icq=' . $q['user_icq'] . '&amp;img=5" width="18" height="18" alt="" />' : '';
	$q_user_yim = ($q['user_yim']) ? 'http://edit.yahoo.com/config/send_webmesg?.target=' . $q['user_yim'] . '&amp;.src=pg' : '';
	$q_user_aim = ($q['user_aim'] && $auth->acl_get('u_sendim')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=aim&amp;u=".$q['user_id']) : '';
	$q_user_jabber = ($q['user_jabber'] && $auth->acl_get('u_sendim')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=jabber&amp;u=".$q['user_id']) : '';

	$topic_mod = '';
	$topic_mod .= ( $auth->acl_get('m_') || $auth->acl_get('a_') || $user_id == $q['q_user_id'] ) && $q['q_mode'] != 9 ? '<option value="lock" >' . $user->lang['UFAQ_MOD_CLOSE'] . '</option>' : '';
	$topic_mod .= ( $auth->acl_get('m_') || $auth->acl_get('a_') ) && ( $q['q_mode'] == 9 || $q['q_mode'] == 1 ) ? '<option value="unlock" >' . $user->lang['UFAQ_MOD_OPEN'] . '</option>' : '';
	$topic_mod .= ( $auth->acl_get('m_') || $auth->acl_get('a_') || $user_id == $q['q_user_id'] ) && $q['q_mode'] != 1 ? '<option value="lockmod" >' . $user->lang['UFAQ_MOD_CLOSE_MODERATION'] . '</option>' : '';
	$topic_mod .= ($auth->acl_get('m_') || $auth->acl_get('a_')) ? '<option value="move" >' . $user->lang['UFAQ_MOD_MOVE'] . '</option>' : '';

	if ( ($q['q_subj_author'] && $q['q_user_id'] == ANONYMOUS) || $q['q_user_hidenick'] )
	{
		$quoted_username = get_username_string('username', 0, $q['q_subj_author'], '#ffffff');
	}
	else
	{
		$quoted_username = get_username_string('username', $q['q_user_id'], $q['username'], $q['user_colour']);
	}
					
	$template->assign_vars(array(
	'QUEST'	=> $q['q_subj'],
	'AVATAR'	=> $config['ufaq_avatar_questors'] ? ($user->optionget('viewavatars') ? get_user_avatar($q['user_avatar'], $q['user_avatar_type'], $q['user_avatar_width'], $q['user_avatar_height']) : '') : '',
	'RATING'	=> $q['q_rating'],
	'RATING_USE'	=> $ufaq_use_rating,
	'FORUM_NAME'		=> $row['cat_name'],

	'Q_TEXT'	=> generate_text_for_display($q['q_text'], $q['bbcode_uid'], $q['bbcode_bitfield'], 7),
	'S_BBCODE_ALLOWED'	=> true,
	'S_BBCODE_QUOTE'	=> true,
	'S_BBCODE_IMG'	=> true,
	'EDIT_IMG' 			=> $user->img('icon_post_edit', 'UFAQ_EDIT'),
	'DELETE_IMG' 		=> $user->img('icon_post_delete', 'DELETE'),
	'TIME'		=> $user->format_date($q['q_time']),
	'USER'		=> get_username_string('full', $q['q_user_id'], $q['username'], $q['user_colour']),
	'U_USER'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u='.$q['q_user_id']),
	'U_LINK'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$q['q_id']),
	'S_CAN_QUEST'		=> $auth->acl_get('u_add_question') ? $user->lang['UFAQ_CAN_QUEST'] : $user->lang['UFAQ_CANT_QUEST'],
	'S_CAN_ANSWER'		=> $auth->acl_get('u_add_answers') && $q['q_mode'] == 0 ? $user->lang['UFAQ_CAN_ANSWER'] : $user->lang['UFAQ_CANT_ANSWER'],
	'S_ADD_A_ACTION'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=add_a&amp;id='.$q['q_id']),
	'S_SHOW_SMILEY_LINK' 	=> true,
	'U_MORE_SMILIES' 		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=smilies'),
	'REPLY'		=> $user->data['is_bot'] || !$auth->acl_get('u_add_answers') ? '' : $user->img('button_question_reply', 'UFAQ_ADD_ANSWER'),
	'U_EDIT'	=> ($auth->acl_get('u_add_question') && $user->data['user_id'] == $q['q_user_id'] && $q['q_mode'] != 9) || ($auth->acl_get('m_') && $auth->acl_get('u_add_answers') && $q['q_mode'] != 9) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=edit&amp;id='.$q['q_id']) : '',

		//'POSTER_QUOTE'		=> '',	//addslashes($quoted_username),
		'S_QUOTE'	=> $auth->acl_get('u_add_answers') && $q['q_mode'] == 0 ? true : false,
		'S_QUICK_REPLY'		=> true,
	
	'U_DEL'	=> ($auth->acl_get('u_add_answers') && $user->data['user_id'] == $q['q_user_id']) || ($auth->acl_get('m_') && $auth->acl_get('u_add_answers')) || $auth->acl_get('a_') ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=del&amp;id='.$q['q_id']) : '',
	'COUNT' => $result_count,
	'U_RATE_PLUS'	=> $q['q_mode'] == 0 && $user_id != $q['q_user_id'] && !in_array($user_id, explode(",",$q['q_raters'])) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=rate&amp;id='.$q['q_id']) : '',
	'U_RATE_MINUS'	=> $q['q_mode'] == 0 && $user_id != $q['q_user_id'] && !in_array($user_id, explode(",",$q['q_raters_minus'])) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=unrate&amp;id='.$q['q_id']) : '',

	'POSTER_WARNINGS' => (isset($q['user_warnings'])) ? $q['user_warnings'] : 0,
	'POSTER_IP'		=> ($auth->acl_get('m_') || $auth->acl_get('a_')) && isset($q['q_user_ip']) ? $q['q_user_ip'] : '',
	'POSTER_FAKENICK'	=> isset($q['q_subj_author']) || (isset($q['q_subj_author']) && $q['q_user_hidenick'] != 0) ? $q['q_subj_author'] : '',
	'POSTER_HIDENICK'	=> $q['q_user_hidenick'] != 0 ? true : false,
	'VIEW_RIGHTS'	=> ($user_id != ANONYMOUS && $q['q_user_id'] == $user_id) || $auth->acl_get('m_') || $auth->acl_get('a_') ? true : false,
	
	'U_WATCH'	=> $ufaq_use_watching && !$user->data['is_bot'] && !in_array($user_id, explode(",",$q['q_users_watch'])) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=watch&amp;id='.$q['q_id']) : '',
	'U_UNWATCH'	=> $ufaq_use_watching && !$user->data['is_bot'] && in_array($user_id, explode(",",$q['q_users_watch'])) ? append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=unwatch&amp;id='.$q['q_id']) : '',
	
		'RANK_TITLE'			=> ($q['q_user_id'] != ANONYMOUS ? $q['rank_title'] : ''),
		'RANK_IMG'				=> ($q['q_user_id'] != ANONYMOUS ? $q['rank_image'] : ''),
		'RANK_IMG_SRC'			=> ($q['q_user_id'] != ANONYMOUS ? $q['rank_image_src'] : ''),
		'POSTER_POSTS'			=> ($q['q_user_id'] != ANONYMOUS ? $q['user_posts'] : ''),
		'POSTER_JOINED'			=> ($q['q_user_id'] != ANONYMOUS ? $user->format_date($q['user_regdate']) : ''),
		'POSTER_FROM'			=> ($q['q_user_id'] != ANONYMOUS ? $q['user_from'] : ''),
		'U_PM'					=> ($q['q_user_id'] != ANONYMOUS && $config['allow_privmsg'] && $q['q_user_id'] != $q['user_id'] && $auth->acl_get('u_sendpm') && ($q['user_allow_pm'] || $auth->acl_gets('a_', 'm_') || $auth->acl_getf_global('m_'))) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=compose&amp;action=quotepost&amp;') : '',
		'U_EMAIL'				=> ($q['q_user_id'] != ANONYMOUS ? $q_user_email : ''),
		'U_WWW'					=> ($q['q_user_id'] != ANONYMOUS ? $q['user_website'] : ''),
		'U_MSN'					=> ($q['q_user_id'] != ANONYMOUS ? $q_user_msnm : ''),
		'U_ICQ'					=> ($q['q_user_id'] != ANONYMOUS ? $q_user_icq : ''),
		'U_YIM'					=> ($q['q_user_id'] != ANONYMOUS ? $q_user_yim : ''),
		'U_AIM'					=> ($q['q_user_id'] != ANONYMOUS ? $q_user_aim : ''),
		'U_JABBER'				=> ($q['q_user_id'] != ANONYMOUS ? $q_user_jabber : ''),

	'MINI_POST_IMG'			=> $user->img('icon_post_target', 'POST'),

	'S_TOPIC_MOD' 			=> ($topic_mod != '') ? '<select name="action" id="mod_selector" onChange="showCat(); return true;">' . $topic_mod . '</select>' : '',
	'S_MOD_ACTION' 			=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=mod&amp;id='.$id),
	'S_CAT_MOD' 			=> ($cat_mod != '') ? '<select name="cat_action" >' . $cat_mod . '</select>' : '',
	
	'S_MODE'	=> $q['q_mode'],

//	'ONLINE_IMG'			=> ($poster_id == ANONYMOUS || !$config['load_onlinetrack']) ? '' : (($user_cache[$poster_id]['online']) ? $user->img('icon_user_online', 'ONLINE') : $user->img('icon_user_offline', 'OFFLINE')),
//	'S_ONLINE'				=> ($q['q_user_id'] == ANONYMOUS || !$config['load_onlinetrack']) ? false : (($user_cache[$poster_id]['online']) ? true : false),
	)
	);

	// +1 к просмотрам
	if (isset($user->data['session_page']) && !$user->data['is_bot'] && (strpos($user->data['session_page'], 'mode=q&id=' . $id) === false || isset($user->data['session_created'])))
	{
		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
			SET q_views = q_views + 1
			WHERE q_id ='.$id;
		$db->sql_query($sql);
	}

	if($auth->acl_get('u_add_answers'))
	{		include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
		generate_smilies('inline', 0);
		display_custom_bbcodes();	}

	// Output page
	page_header($q['q_subj']);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);}
elseif($mode == 'add_q' && $id && !$user->data['is_bot'] && $auth->acl_get('u_add_question'))
{	if(!$auth->acl_get('u_add_question'))
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}

	$user->setup('posting');
	$sql = 'SELECT cat_name, cat_count
			FROM ' . Q_CATS_TABLE . '
			WHERE cat_id = '.$id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

	if(!$row)
	{
		trigger_error($user->lang['UFAQ_NO_CAT']);
	}

	$template->assign_vars(array(
	'ADD_QUEST'	=> $auth->acl_get('u_add_question') ? true : false,
	'Q_HIDENICK'	=> false,
	'Q_QUESTNAME'	=> '',
	'S_BBCODE_ALLOWED'	=> true,
	'S_BBCODE_QUOTE'	=> true,
	'S_BBCODE_IMG'	=> true,
	'S_SHOW_SMILEY_LINK' 	=> true,
	'U_MORE_SMILIES' 		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=smilies'),
	'S_ADD_A_ACTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=save_q&amp;id='.$id),
	)
	);

	// Хлебные крошки
	$template->assign_block_vars('navlinks',array(
		'FORUM_NAME'		=> $row['cat_name'],
		'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id),
	)
	);

	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	generate_smilies('inline', 0);
	display_custom_bbcodes();

	// Output page
	page_header($user->lang['UFAQ_ADD_QUEST'].' &bull; '.$row['cat_name']);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);}
elseif($mode == 'add_a' && $id && !$user->data['is_bot'] && $auth->acl_get('u_add_answers'))
{	if(!$auth->acl_get('u_add_answers'))
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}

	$text = utf8_normalize_nfc(request_var('message', '', true));

	if(!$text)
	{		trigger_error($user->lang['UFAQ_NO_ANSWER']);	}

	if ($user_id == ANONYMOUS)
	{
		$subj_author = utf8_normalize_nfc(request_var('subj_author', '', true));
		if (!$subj_author) $subj_author = "{L_GUEST}";
	}
	else
	{
		$subj_author = '';
	}
	
	// Проверяем есть ли такой вопрос
	$sql = 'SELECT q_id, q_user_id, q_subj, q_users_watch
		FROM ' . Q_QUESTION_TABLE . '
		WHERE q_type = 1
		AND q_id = '.$id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		if(!$row)
		{
			trigger_error($user->lang['UFAQ_NO_QUEST']);
		}
		$db->sql_freeresult($result);

	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
    $time = time();

	$sql_ary = array(			// NEW ANSWER
		'q_parent_q'			=> $id,
		'q_time'				=> $time,
		'q_text'				=> $text,
		'bbcode_uid'			=> $uid,
		'bbcode_bitfield'			=> $bitfield,
		'q_user_id'			=> $user->data['user_id'],
		'q_raters'	=> 0,
		'q_raters_minus'	=> 0,
		'q_users_watch'	=> 0,

		'q_user_ip'		=> $user->ip,
		'q_subj_author'		=> $subj_author,
		'q_user_hidenick'		=> 0,
		'q_mode'		=> 0,
	);

	$sql = 'INSERT INTO ' . Q_QUESTION_TABLE . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);

	// +1 к ответам
	$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
		SET q_answers = q_answers + 1
		WHERE q_id ='.$id;
	$db->sql_query($sql);

		$sql = 'SELECT q_id
			FROM ' . Q_QUESTION_TABLE . '
			WHERE q_time = '.$time;
			$result = $db->sql_query($sql);
			$q = $db->sql_fetchrow($result);

			$ids = $q['q_id'] ? '#' . $q['q_id'] : '';	

	// Мессаги подписчикам
	if($row['q_users_watch'] && $ufaq_use_watching)
	{
			include($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
			$send_list = $row['q_users_watch'] ? explode(",", $row['q_users_watch']) : '';
			foreach ($send_list as $i => $watcher_id)
	        {
				if ($watcher_id && $watcher_id != $user_id)
				{
					$pm_data = array(
						'from_user_id'			=> $user->data['user_id'],
						'from_user_ip'			=> $user->ip,
						'from_username'			=> $user->data['username'],
						'enable_sig'			=> false,
						'enable_bbcode'			=> false,
						'enable_smilies'		=> false,
						'enable_urls'			=> false,
						'icon_id'				=> 0,
						'bbcode_bitfield'		=> '',
						'bbcode_uid'			=> '',
						'message'				=> sprintf($user->lang['UFAQ_PM_MESSAGE_WATCH'], $phpbb_root_path.'u_faq.php?mode=q&id='.$id.'#'.$q['q_id'], $row['q_subj']),
						'address_list'			=> array('u' => array($watcher_id => 'to')),
					);
					submit_pm('post', '[UAFQ] "'.$row['q_subj'].'" ' . $user->lang['UFAQ_PM_SUBJ_WATCH'], $pm_data, false);
				}
			}

	}

	$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$id.$ids);
	$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
	meta_refresh(2, $meta_url);
	trigger_error(sprintf($user->lang['UFAQ_ANSWER_ADDED'], $meta_url, $index_u));
}
elseif($mode == 'save_q' && $id && !$user->data['is_bot'] && $auth->acl_get('u_add_question'))
{
	if(!$auth->acl_get('u_add_question'))
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}

	// Проверяем есть ли такой раздел
	$sql = 'SELECT cat_count, cat_users_watch
		FROM ' . Q_CATS_TABLE . '
		WHERE cat_id = '.$id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		if(!$row)
		{
			trigger_error($user->lang['UFAQ_NO_QUEST']);
		}
		$db->sql_freeresult($result);

	$q_mode = 0;
	$subj = utf8_normalize_nfc(request_var('subj', '', true));
	$text = utf8_normalize_nfc(request_var('message', '', true));
	$watch = (int) request_var('watch', 0);
	$subj_authorhide = (int) request_var('authorhide', 0);
	$subj_author = utf8_normalize_nfc(request_var('subj_author', '', true));	

	if ($user_id == ANONYMOUS)
	{
		if (!$subj_author) $subj_author = "{L_GUEST}";
		if ($config['ufaq_guest_premode']) $q_mode = 1;	// Premoderation
	}
	else
	{
		if ($subj_authorhide != 0)
		{
			if (!$subj_author)
			{
				$subj_authorhide = 0;
			}
		}
	}
	
	if(!$subj)
	{
		trigger_error($user->lang['UFAQ_NO_SUBJ']);
	}
	if(!$text)
	{
		trigger_error($user->lang['UFAQ_NO_QUESTION']);
	}

	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
    $time = time();

	$sql_ary = array(		// NEW QUESTION
		'q_parent'			=> $id,
		'q_type'			=> 1,
		'q_time'				=> $time,
		'q_subj'				=> $subj,
		'q_text'				=> $text,
		'q_subj_author'		=> $subj_author,
		'q_user_hidenick'		=> $subj_authorhide,
		'q_user_ip'			=> $user->ip,
		'q_mode'				=>  $q_mode,
		'bbcode_uid'			=> $uid,
		'bbcode_bitfield'			=> $bitfield,
		'q_user_id'			=> $user->data['user_id'],
		'q_raters'	=> 0,
		'q_raters_minus'	=> 0,
		'q_users_watch'	=> $watch ? $user_id : 0,
	);

	$sql = 'INSERT INTO ' . Q_QUESTION_TABLE . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);

	$sql = 'SELECT q_id
		FROM ' . Q_QUESTION_TABLE . '
		WHERE q_user_id = '.$user_id.'
		ORDER BY q_id DESC';
		$result = $db->sql_query($sql);
		$qwestion = $db->sql_fetchrow($result);

	$sql_arr = array(
	    'cat_count' => $row['cat_count'] + 1,
	    'last_question_id' => $qwestion['q_id'],
	    'last_question_name' => $subj,
	    'last_question_time' => $time,
	);

	$sql = 'UPDATE ' . Q_CATS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
			WHERE cat_id = $id";
	$db->sql_query($sql);

		// Мессаги подписчикам
		if($row['cat_users_watch'] && $ufaq_use_watching)
		{
				include($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
				$send_list = $row['cat_users_watch'] ? explode(",", $row['cat_users_watch']) : '';
				foreach ($send_list as $i => $watcher_id)
				{
					if ($watcher_id && $watcher_id != $user_id)
					{
						$pm_data = array(
							'from_user_id'			=> $user->data['user_id'],
							'from_user_ip'			=> $user->ip,
							'from_username'			=> $user->data['username'],
							'enable_sig'			=> false,
							'enable_bbcode'			=> false,
							'enable_smilies'		=> false,
							'enable_urls'			=> false,
							'icon_id'				=> 0,
							'bbcode_bitfield'		=> '',
							'bbcode_uid'			=> '',
							'message'				=> sprintf($user->lang['UFAQ_CAT_PM_MESSAGE_WATCH'], $phpbb_root_path.'u_faq.php?mode=q&id='.$qwestion['q_id'], $subj),
							'address_list'			=> array('u' => array($watcher_id => 'to')),
						);
						submit_pm('post', '[UAFQ] "'.$subj.'" ' . $user->lang['UFAQ_CAT_PM_SUBJ_WATCH'], $pm_data, false);
					}
				}
		}
	
	$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$qwestion['q_id']);
	$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
	meta_refresh(5, $meta_url);
	trigger_error(sprintf($user->lang['UFAQ_QUESTION_ADDED'], $meta_url, $index_u));

}
elseif($mode == 'del' && $id && !$user->data['is_bot'])
{	$m_perm = $auth->acl_get('m_') || $auth->acl_get('u_add_answers') || $auth->acl_get('a_') ? true : false;

	$sql = 'SELECT q_parent, q_parent_q, q_type, q_user_id
			FROM ' . Q_QUESTION_TABLE . '
			WHERE q_id = '.$id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
	// Проверяем права
	if(!$row)
	{
		trigger_error($user->lang['UFAQ_NO_QUEST']);
	}
    if($row['q_type'] && $row['q_user_id'] != $user->data['user_id'] && !$m_perm)
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}
	elseif(!$row['q_type'] && $row['q_user_id'] != $user->data['user_id'] && !$m_perm)
	{		trigger_error($user->lang['UFAQ_NO_PERMISSION']);	}

	$where = $row['q_type'] ? ' OR q_parent_q = '.$id : '';
	$sql = 'DELETE FROM ' . Q_QUESTION_TABLE . "
			WHERE q_id = $id
			$where";
	$db->sql_query($sql);

	// Если удаляется вопрос, то проверяем инфу в его категории и при необходимости обновляем
	if($row['q_type'])
	{
		$sql = 'SELECT cat_id, cat_count, last_question_id
			FROM ' . Q_CATS_TABLE . '
			WHERE cat_id = '.$row['q_parent'];
			$result = $db->sql_query($sql);
			$cat = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

		if($cat['last_question_id'] == $id)
		{			$sql = 'SELECT q_id, q_subj, q_time
					FROM ' . Q_QUESTION_TABLE . '
					WHERE q_parent = '.$cat['cat_id'].'
					ORDER BY q_id DESC';
					$result = $db->sql_query($sql);
					$new_row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

			$sql_arr = array(
			    'cat_count' => $cat['cat_count'] - 1,
			    'last_question_id' => $new_row['q_id'] ? $new_row['q_id'] : 0,
			    'last_question_name' => $new_row['q_subj'] ? $new_row['q_subj'] : '',
			    'last_question_time' => $new_row['q_time'] ? $new_row['q_time'] : 0,
			);
		}
		else
		{			$sql_arr = array(
			    'cat_count' => $cat['cat_count'] - 1,
			);		}
        $cat_id = $cat['cat_id'];
		$sql = 'UPDATE ' . Q_CATS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
				WHERE cat_id = $cat_id";
		$db->sql_query($sql);

		$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$cat_id);
		$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
		meta_refresh(3, $meta_url);
		trigger_error(sprintf($user->lang['UFAQ_QUESTION_DELETED'], $meta_url, $index_u));
	}
	else
	{		// -1 к ответам
		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
			SET q_answers = q_answers - 1
			WHERE q_id ='.$row['q_parent_q'];
		$db->sql_query($sql);

		$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$row['q_parent_q']);
		$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
		meta_refresh(2, $meta_url);
		trigger_error(sprintf($user->lang['UFAQ_ANSWER_DELETED'], $meta_url, $index_u));	}
}
elseif($mode == 'edit' && $id && !$user->data['is_bot'])
{	$m_perm = $auth->acl_get('m_') && $auth->acl_get('u_add_answers') ? true : false;

	$sql = 'SELECT *
			FROM ' . Q_QUESTION_TABLE . '
			WHERE q_id = '.$id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
	// Проверяем права
	if(!$row)
	{
		trigger_error($user->lang['UFAQ_NO_QUEST']);
	}
    if($row['q_type'] && $row['q_user_id'] != $user->data['user_id'] && !$m_perm)
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}
	elseif(!$row['q_type'] && $row['q_user_id'] != $user->data['user_id'] && !$m_perm)
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}
    $user->setup('posting');
    decode_message($row['q_text'], $row['bbcode_uid']);

	$template->assign_vars(array(
	'ADD_QUEST'	=> true,
	'REPLY'	=> $row['q_type'] ? false : true,
	'Q_SUBJ'	=> $row['q_subj'],
	'Q_QUESTNAME'	=> $row['q_subj_author'] ? $row['q_subj_author'] : '',
	'Q_HIDENICK'	=> $row['q_user_hidenick'] ? $row['q_user_hidenick'] : 0,
	'TEXT'	=> $row['q_text'],
	'Q_WATCH'	=> in_array($user_id, explode(",",$row['q_users_watch'])) ? true : false,
	'S_BBCODE_ALLOWED'	=> true,
	'S_BBCODE_QUOTE'	=> true,
	'S_BBCODE_IMG'	=> true,
	'S_SHOW_SMILEY_LINK' 	=> true,
	'U_MORE_SMILIES' 		=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=smilies'),
	'S_ADD_A_ACTION'	=> append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=save_edit&amp;id='.$id),
	'WATCHING_USE'	=> $ufaq_use_watching,
	)
	);

	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	generate_smilies('inline', 0);
	display_custom_bbcodes();

	// Output page
	page_header($user->lang['UFAQ_EDIT']);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);}
elseif($mode == 'save_edit' && $id && !$user->data['is_bot'])
{	$m_perm = $auth->acl_get('m_') && $auth->acl_get('u_add_answers') ? true : false;

	$sql = 'SELECT *
			FROM ' . Q_QUESTION_TABLE . '
			WHERE q_id = '.$id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
	// Проверяем права
	if(!$row)
	{
		trigger_error($user->lang['UFAQ_NO_QUEST']);
	}
    if($row['q_type'] && $row['q_user_id'] != $user->data['user_id'] && !$m_perm)
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}
	elseif(!$row['q_type'] && $row['q_user_id'] != $user->data['user_id'] && !$m_perm)
	{
		trigger_error($user->lang['UFAQ_NO_PERMISSION']);
	}

	$text = utf8_normalize_nfc(request_var('message', '', true));
	if(!$text)
	{
		trigger_error($user->lang['UFAQ_NO_ANSWER']);
	}
	$subj_mode = $row['q_mode'];
	$subj_authorhide = (int) request_var('authorhide', 0);
	$subj_author = utf8_normalize_nfc(request_var('subj_author', '', true));	
	
	$watch = (int) request_var('watch', 0);

	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

	if($row['q_type'])
	{
		$subj = utf8_normalize_nfc(request_var('subj', '', true));
		$redirect_id = $id;
		$q_parent = $row['q_parent'];

		if(!$subj)
		{
			trigger_error($user->lang['UFAQ_NO_SUBJ']);
		}

        // Обновляем данные в категории, если редактируемый вопрос в ней последний
		$sql_parent = array(
		    'last_question_name' => $subj,
		);

		$sql = 'UPDATE ' . Q_CATS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_parent) . "
				WHERE cat_id = $q_parent
				AND last_question_id = $id";
		$db->sql_query($sql);
		$watcher = '';
		$watcher = explode(",",$row['q_users_watch']);
		if ( $watch )
		{
			if(!in_array($user_id, $watcher))
			{
				$watcher[] = $user_id;
			}
		}
		else
		{
			if(in_array($user_id, $watcher))
			{
				$key = array_search($user_id, $watcher);
					if ($key != false)
					{
						unset($watcher[$key]);
					}
				$watcher = array_values($watcher);
			}
		}
		$watcher = implode(",",$watcher);
		
		$sql_arr = array(
		    'q_subj' => $subj,
		    'q_text' => $text,
		    'bbcode_uid'			=> $uid,
			'bbcode_bitfield'		=> $bitfield,
			'q_users_watch' => $watcher,

			'q_subj_author'		=> $subj_author,
			'q_user_hidenick'		=> $subj_authorhide,
			'q_user_ip'			=> $user->ip,
			'q_mode'				=> $subj_mode,
		);
	}
	else
	{		$redirect_id = $row['q_parent_q'];
		$sql_arr = array(
		    'q_text' => $text,
		    'bbcode_uid'			=> $uid,
			'bbcode_bitfield'		=> $bitfield,

			'q_subj_author'		=> $subj_author,
			'q_user_hidenick'		=> $subj_authorhide,
			'q_user_ip'			=> $user->ip,
			'q_mode'				=> $subj_mode,
		);	}

	$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
			WHERE q_id = $id";
	$db->sql_query($sql);

	$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect_id);
	$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
	meta_refresh(2, $meta_url);
	trigger_error(sprintf($user->lang['UFAQ_QUESTION_EDITED'], $meta_url, $index_u));}
elseif( ($mode == 'rate' || $mode == 'unrate') && $id && !$user->data['is_bot'])
{	$sql = 'SELECT q_id, q_parent_q, q_user_id, q_rating, q_raters, q_raters_minus
		FROM ' . Q_QUESTION_TABLE . '
		WHERE q_id = '.$id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

	if($row && $ufaq_use_rating)
	{		$raters_pl = $row['q_raters'] ? $row['q_raters'] : '0';
		$raters_mi = $row['q_raters_minus'] ? $row['q_raters_minus'] : '0';
		$rating = $row['q_rating'] ? $row['q_rating'] : 0;		
        $redirect = $row['q_parent_q'] ? $row['q_parent_q'] : $id;
		$redirect_id = $row['q_id'] ? '#' . $row['q_id'] : '';

		if($row['q_user_id'] == $user_id)
		{
			$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect.$redirect_id);
			meta_refresh(3, $meta_url);			trigger_error($user->lang['UFAQ_RATE_SELF']);		}

		if ( ($raters_pl == '' && $mode == 'rate') || ($raters_mi == '' && $mode == 'unrate') )
		{			if ( $mode == 'rate' ) 
			{
				$raters_pl = $user_id;
				$rating = $rating + 1;
			}
			else
			{
				$raters_mi = $user_id;
				$rating = $rating - 1;
			}
		}
		else
		{			$raters_pl = explode(",",$row['q_raters']);
			$raters_mi = explode(",",$row['q_raters_minus']);
						if ( (in_array($user_id, $raters_pl) && $mode == 'rate') || (in_array($user_id, $raters_mi) && $mode == 'unrate') )	// ВЫ УЖЕ ГОЛОСОВАЛИ
			{
				$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect.$redirect_id);
				meta_refresh(3, $meta_url);
				trigger_error($user->lang['UFAQ_ALREDY_RATED']);
			}
			else
			{				if ( $mode == 'rate' )
				{
					if ( in_array($user_id, $raters_mi) )
					{
						$key = array_search($user_id, $raters_mi);
						if ($key != false)
						{
							unset($raters_mi[$key]);	// Убираем минус если есть
						}
					}

					$raters_pl[] = $user_id;
					$rating = $rating + 1;
				}
				else
				{
					if ( in_array($user_id, $raters_pl) )
					{
						$key = array_search($user_id, $raters_pl);
						if ($key != false)
						{
							unset($raters_pl[$key]);	// Убираем плюс если был
						}
					}

					$raters_mi[] = $user_id;
					$rating = $rating - 1;
				}
				$raters_pl = array_values($raters_pl);
				$raters_mi = array_values($raters_mi);
				$raters_pl = implode(",",$raters_pl);
				$raters_mi = implode(",",$raters_mi);
			}
		}

		$sql_arr = array(
			'q_rating' => $rating,
			'q_raters' => $raters_pl,
			'q_raters_minus' => $raters_mi,
		);

		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
				WHERE q_id = $id";
		$db->sql_query($sql);

		$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect.$redirect_id);
		$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
		meta_refresh(1, $meta_url);
		trigger_error(sprintf($user->lang['UFAQ_RATED'], $meta_url, $index_u));	}
	else
	{
		trigger_error($user->lang['NO_MODE']);	}}
elseif( ($mode == 'watch' || $mode == 'unwatch') && $id && !$user->data['is_bot'])
{
	$sql = 'SELECT q_parent_q, q_user_id, q_users_watch
		FROM ' . Q_QUESTION_TABLE . '
		WHERE q_type = 1
		AND q_id = '.$id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

	if($row && $ufaq_use_watching)
	{
        $redirect = $row['q_parent_q'] ? $row['q_parent_q'] : $id;
		$watcher = '';
		$watcher = explode(",",$row['q_users_watch']);
		if ( $mode == 'watch' )
		{
			if(in_array($user_id, $watcher))
			{
				$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect);
				meta_refresh(2, $meta_url);
				trigger_error($user->lang['UFAQ_ALREDY_WATCH']);
			}
			else
			{
				$watcher[] = $user_id;
			}
		}
		if ( $mode == 'unwatch' )
		{
			if(!in_array($user_id, $watcher))
			{
				$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect);
				meta_refresh(2, $meta_url);
				trigger_error($user->lang['UFAQ_ALREDY_UNWATCH']);
			}		
			else
			{
				if (count($watcher) == 1 && in_array($user_id, $watcher) )	// Костыль
				{
					$watcher = '';
					$watcher[] = '0';
				}
				else
				{				
					$key = array_search($user_id, $watcher);
						if ($key != false)
						{
							unset($watcher[$key]);
						}
					$watcher = array_values($watcher);
				}
			}
		}
		$watcher = implode(",",$watcher);
		$sql_arr = array(
		    'q_users_watch' => $watcher,
		);

		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
				WHERE q_id = $id";
		$db->sql_query($sql);

		$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$redirect);
		$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
		meta_refresh(3, $meta_url);
		if ($mode == 'watch')
		{
			trigger_error(sprintf($user->lang['UFAQ_WATCHED'], $meta_url, $index_u));
		}
		else
		{
			trigger_error(sprintf($user->lang['UFAQ_UNWATCHED'], $meta_url, $index_u));
		}
	}
	else
	{
		trigger_error($user->lang['NO_MODE']);
	}
}
elseif( ($mode == 'catw' || $mode == 'catunw') && $id && !$user->data['is_bot'])
{
	$sql = 'SELECT cat_users_watch
			FROM ' . Q_CATS_TABLE . '
			WHERE cat_id = '.$id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

	if($row && $ufaq_use_watching)
	{
		$watcher = '';
		$watcher = explode(",",$row['cat_users_watch']);
		if ( $mode == 'catw' )
		{
			if(in_array($user_id, $watcher))
			{
				$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id);
				meta_refresh(2, $meta_url);
				trigger_error($user->lang['UFAQ_CAT_ALREDY_WATCH']);
			}
			else
			{
				$watcher[] = $user_id;
			}
		}
		if ( $mode == 'catunw' )
		{
			if(!in_array($user_id, $watcher))
			{
				$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id);
				meta_refresh(2, $meta_url);
				trigger_error($user->lang['UFAQ_CAT_ALREDY_UNWATCH']);
			}		
			else
			{
				if (count($watcher) == 1 && in_array($user_id, $watcher) )	// Костыль
				{
					$watcher = '';
					$watcher[] = '0';
				}
				else
				{				
					$key = array_search($user_id, $watcher);
						if ($key != false)
						{
							unset($watcher[$key]);
						}
					$watcher = array_values($watcher);
				}
			}
		}
		$watcher = implode(",",$watcher);
		$sql_arr = array(
		    'cat_users_watch' => $watcher,
		);

		$sql = 'UPDATE ' . Q_CATS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
				WHERE cat_id = $id";
		$db->sql_query($sql);

		$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=cat&amp;id='.$id);
		$index_u = append_sid("{$phpbb_root_path}index.$phpEx");
		meta_refresh(3, $meta_url);
		if ($mode == 'catw')
		{
			trigger_error(sprintf($user->lang['UFAQ_CAT_WATCHED'], $meta_url, $index_u));
		}
		else
		{
			trigger_error(sprintf($user->lang['UFAQ_CAT_UNWATCHED'], $meta_url, $index_u));
		}
	}
	else
	{
		trigger_error($user->lang['NO_MODE']);
	}
}
elseif($mode == 'smilies')
{	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	$sql = '';
	generate_smilies('window', 0);}

elseif( $mode == 'mod' && $id && !$user->data['is_bot'] && ($auth->acl_get('m_') || $auth->acl_get('a_')) )
{
	$mod_action = request_var('action', '');
	$s_mod_action = $user->lang['NO_MODE'];
	if (!$mod_action)
	{
		trigger_error($s_mod_action);
	}

	$meta_url = append_sid("{$phpbb_root_path}u_faq.$phpEx", 'mode=q&amp;id='.$id);
	
	if ($mod_action == "lock")
	{
		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
			SET q_mode = 9
			WHERE q_id = ' . $id;
		$db->sql_query($sql);
		$s_mod_action = $user->lang['UFAQ_MOD_CLOSED'];
	}
	if ($mod_action == "lockmod")
	{
		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
			SET q_mode = 1
			WHERE q_id = ' . $id;
		$db->sql_query($sql);
		$s_mod_action = $user->lang['UFAQ_MOD_PREMODERATION'];
	}
	if ($mod_action == "unlock")
	{
		$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
			SET q_mode = 0
			WHERE q_id = ' . $id;
		$db->sql_query($sql);
		$s_mod_action = $user->lang['UFAQ_MOD_OPENED'];
	}
	if ($mod_action == "move")
	{
		$cat_action = request_var('cat_action', '');
		if ( strcmp($cat_action, "cat_") )
		{
			$cat_action = str_replace('cat_', '', $cat_action);
			
			$sql = 'UPDATE ' . Q_QUESTION_TABLE . '
				SET q_parent = '.$cat_action.'
				WHERE q_id = ' . $id;
			$db->sql_query($sql);
			ufaq_recalculate_cat();
			$s_mod_action = $user->lang['UFAQ_MOD_MOVED'];
		}
	}
	meta_refresh(1, $meta_url);
	trigger_error($s_mod_action);
}

else
{	trigger_error($user->lang['NO_MODE']);}

}	// UFAQ_ENABLE END
else
{	// UFAQ_DISABLE BEGIN
	page_header($user->lang['UFAQ_DISABLED']);

	$template->set_filenames(array(
	   'body' => 'ufaq_body.html')
	);

}
page_footer();

// Functions

function ufaq_bbcode_strip($text)
{
	static $RegEx = array();
	static $bbcode_strip = 'flash';
	$text_html = array('&quot;','&amp;','&#039;','&lt;','&gt;');
	$text = str_replace($text_html,'',$text);
	if (empty($RegEx))
	{
		$RegEx = array('`<[^>]*>(.*<[^>]*>)?`Usi', // HTML code
			'`\[(' . $bbcode_strip . ')[^\[\]]+\].*\[/(' . $bbcode_strip . ')[^\[\]]+\]`Usi', // bbcode to strip
			'`\[/?[^\[\]]+\]`mi', // Strip all bbcode tags
			'`[\s]+`' // Multiple spaces
		);
	}
	return preg_replace($RegEx, ' ', $text );
}

function ufaq_make_message_len($tmp_str, $tmp_bbcode_uid, $tmp_bbcode_bitfield)
{
	global $config;
	// We need remove all bbcodes from hover text
	$tmp_str = ufaq_bbcode_strip($tmp_str);
	// Censore text
	$tmp_str = censor_text($tmp_str);
	// Trim to len
	$trim = new phpbb_trim_message($tmp_str, $tmp_bbcode_uid, $config['ufaq_tooltip_len']);
	$tmp_str = $trim->message();
	unset($trim);
	$tmp_str = str_replace("\n", '<br />', $tmp_str);
	return $tmp_str;
}

function ufaq_recalculate_cat()
{
// ПЕРЕСЧИТАТЬ КОЛИЧЕСТВО ВОПРОСОВ В КАТЕГОРИЯХ, ПОСЛЕДНИЕ ВОПРОСЫ, ВРЕМЯ ЭТИХ ВОПРОСОВ
	global $db;
		$sql = 'SELECT *
				FROM ' . Q_CATS_TABLE . '
				ORDER BY cat_name ASC, cat_id ASC';
				$result = $db->sql_query($sql);

				while($row = $db->sql_fetchrow($result))
				{
					$cat_count = $cat_last_question_time = $cat_last_question_id = 0;
					$cat_last_question_name = '';				
				
					$sql_cnt = "SELECT COUNT(q_id) AS cat_count
						FROM " . Q_QUESTION_TABLE . " q
						WHERE q.q_parent = " . $row['cat_id'] . "
						AND q.q_type = 1";
						$result_cnt = $db->sql_query($sql_cnt);
						$cat_count = (int) $db->sql_fetchfield('cat_count');
						$db->sql_freeresult($result_cnt);
					
					$sql_last = 'SELECT q.*
						FROM ' . Q_QUESTION_TABLE . " q
							WHERE q.q_parent = " . $row['cat_id'] . "
							AND q.q_type = 1
							ORDER BY q.q_time DESC LIMIT 1";
							$result_last = $db->sql_query($sql_last);

							while($row_last = $db->sql_fetchrow($result_last))
							{
								$cat_last_question_id = $row_last['q_id'] ? $row_last['q_id'] : 0;
								$cat_last_question_name = $row_last['q_subj'] ? $row_last['q_subj'] : '';
								$cat_last_question_time = $row_last['q_time'] ? $row_last['q_time'] : 0;
							}
							$db->sql_freeresult($result_last);
							
					$sql_arr = array(
						'cat_count' => $cat_count,
						'last_question_id' => $cat_last_question_id,
						'last_question_name' => $cat_last_question_name,
						'last_question_time' => $cat_last_question_time,
					);		
					$sql_upd = 'UPDATE ' . Q_CATS_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . "
						WHERE cat_id = " . $row['cat_id'];
						$db->sql_query($sql_upd);
				
				}
				$db->sql_freeresult($result);
	return 0;
}
?>