<?php
/**
*
* phpBB Users FAQ [English]
*
* @package language
* @version 1.0.6 $
* @copyright (c) 2012 Axel aka Garret_Dark ( http://www.phpbbstyle.ru/ )
* @license http://www.opensource.org/licenses/rpl1.5.txt Reciprocal Public License 1.5
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'acl_u_add_answers'    => array('lang' => 'Can provide answers to questions (UFAQ)', 'cat' => 'misc'),
    'acl_u_add_question'    => array('lang' => 'Can ask questions (UFAQ)', 'cat' => 'misc'),
	'UFAQ'			=> 'Users FAQ',
	'UFAQ_SUBJ'			=> 'Qustion title',
	'UFAQ_VIEWS'		=> 'Views',
	'UFAQ_CAT'			=> 'Section',
	'UFAQ_CATS'			=> 'Configuration',
	'UFAQ_COUNT'			=> 'Questions',
	'UFAQ_LAST_Q'			=> 'The last question',
	'UFAQ_LAST_A'			=> 'Last answer',
	'UFAQ_EMPTY_CAT'		=> 'No questions',
	'UFAQ_EMPTY_Q'		=> 'This question has no answers',
	'UFAQ_NAME'			=> 'Question',
	'UFAQ_RATING'			=> 'Rating',
	'UFAQ_ANSWERS'			=> 'Answers',
	'UFAQ_ANSWERS_V'		=> 'Answers',
	'UFAQ_QUESTOR'			=> 'Asked',
	'UFAQ_ADD_QUEST'		=> 'Ask a question',
	'UFAQ_ADD_ANSWER'		=> 'Answer the question',
	'UFAQ_ADD_ANSWERS'		=> 'Questions and answers',
	'UFAQ_NO_CAT'		=> 'This section does not exist',
	'UFAQ_NO_QUEST'		=> 'Selected ask does not exist or it is removed',
	'UFAQ_NO_ANSWER'		=> 'The field answer is empty!',
	'UFAQ_NO_QUESTION'		=> 'The field question is empty!',
	'UFAQ_NO_SUBJ'		=> 'Title is empty!',
	'UFAQ_NO_PERMISSION'		=> 'You do not have the rights to this action!',
	'UFAQ_ANSWER_ADDED'		=> 'The answer has been added!<br /><br /><a href="%1$s">Back to the question</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_ANSWER_DELETED'		=> 'The answer is successfully removed!<br /><br /><a href="%1$s">Back to the question</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_QUESTION_ADDED'		=> 'The question has been added!<br /><br /><a href="%1$s">Back to the question</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_QUESTION_DELETED'		=> 'The question has been successfully deleted!<br /><br /><a href="%1$s">Back to the section</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_QUESTION_EDITED'		=> 'Successfully changed!<br /><br /><a href="%1$s">Go to the question</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_EDIT'		=> 'Edit',
	'UFAQ_RATE'		=> 'Vote',
	'UFAQ_RATE_SELF'		=> 'You can not vote for himself!',
	'UFAQ_RATING'		=> 'Rating',
	'UFAQ_RATE_Q'		=> '������� ���� ��� ������',
	'UFAQ_RATE_Q_MINUS'		=> '����������� �����',
	'UFAQ_RATE_A'		=> 'This answer was helpful',
	'UFAQ_RATE_A_MINUS'		=> 'This is a useless answer',
	'UFAQ_RATED'		=> 'Thank you for your vote counted!<br /><br /><a href="%1$s">Back to the question</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_ALREDY_RATED'		=> 'You have already voted!',
	'UFAQ_PM_SUBJECT'		=> 'For Your question...',
	'UFAQ_PM_MESSAGE'		=> 'You can read it by clicking on the link below.<br /><a href="%1$s">%2$s</a>',

	'ACP_ADD_CAT'			=> 'Add section',
	'ACP_CAT_EDITING'			=> 'Edit section',
	'ACP_NO_CATNAME'			=> 'Section name is empty!',
	'CAT_ADDED'				=> 'Added a section ',
	'CAT_EDITED'				=> 'Edited section ',
	'CAT_DELETED'			=> 'Section and all question contained therein are removed successfully',

	// ������ 1.0.2
	'UFAQ_CAT_IMG'		=> 'Section icon',
	'UFAQ_CAT_IMG_EXPLAIN'		=> 'Select the file of the image selection. The files must be in a folder <b>/images/ufaq/</b>',
	'UFAQ_CAN_QUEST'		=> 'You <b>can</b> to ask questions',
	'UFAQ_CANT_QUEST'		=> 'You <b>cant</b> to ask questions',
	'UFAQ_CAN_ANSWER'		=> 'You <b>can</b> to answer questions',
	'UFAQ_CANT_ANSWER'		=> 'You <b>cant</b> to answer questions',

	// ������ 1.0.3
	'UFAQ_NO_RESULT'		=> 'Not specified what to look for',
	'UFAQ_NO_SEARCH_RESULT'		=> 'No search result',
	'UFAQ_SEARCH_TOP'		=> 'Popular Questions',
	'UFAQ_SEARCH_NEW'		=> 'Unanswered Questions',
	'UFAQ_WATCH'		=> 'Subscribe to answers',
	'UFAQ_WATCH_EXP'		=> 'You will be notified by PM of each answer to this question',
	'UFAQ_PM_SUBJ_WATCH'	=> 'Answer...',
	'UFAQ_UNWATCH'		=> 'Unsubscribe from theme',
	'UFAQ_PM_MESSAGE_WATCH'		=> 'Added a new answer to the question to which you have subscribed.<br />You can read it by clicking on the link below.<br /><a href="%1$s">%2$s</a>',
	'UFAQ_ALREDY_WATCH'		=> 'You are already subscribed to the answers to this question!',
	'UFAQ_ALREDY_UNWATCH'		=> 'You are not subscribed to the answers',
	'UFAQ_WATCH_SELF'	=> 'You are the author of this question, subscribe to enable editing question.',
	'UFAQ_WATCHED'		=> 'You have successfully signed up for the answers to this question!<br /><br /><a href="%1$s">Back to question</a><br /><br /><a href="%2$s">Back to index</a>',
	'UFAQ_UNWATCHED'		=> 'You have successfully unsubscribed from the answers to this question!<br /><br /><a href="%1$s">Back to question</a><br /><br /><a href="%2$s">Back to index</a>',
	
	'UFAQ_CAT_WATCH'		=> 'Subscribe to kategory',
	'UFAQ_CAT_WATCH_EXP'	=> 'You will be notified by PM of each question',
	'UFAQ_CAT_UNWATCH'		=> '���������� �� ���������',
	'UFAQ_CAT_UNWATCH_EXP'		=> '����������� � ����� �������� ����� ����������',
	'UFAQ_CAT_WATCHED'		=> '�� ������� ����������� �� ����� ������� � ���� ���������.<br /><br /><a href="%1$s">��������� � ������ ���������</a><br /><br /><a href="%2$s">������� �� ������� �������� ������</a>',
	'UFAQ_CAT_UNWATCHED'		=> '�� ������� ���������� �� ���� ���������.<br /><br /><a href="%1$s">��������� � ������ ���������</a><br /><br /><a href="%2$s">������� �� ������� �������� ������</a>',
	'UFAQ_CAT_ALREDY_WATCH'		=> '�� ��� ��������� �� ��� ���������',
	'UFAQ_CAT_ALREDY_UNWATCH'		=> '�� ��� �� ������������� �� ���������',
	'UFAQ_CAT_PM_SUBJ_WATCH'	=> 'Question...',
	'UFAQ_CAT_PM_MESSAGE_WATCH'		=> '�������� ����� ������ � ���������, �� ������� �� �����������.<br />�� ������ ���������� ��� ������� �� ������ ����.<br /><a href="%1$s">%2$s</a>',
	
	'UFAQ_SETTINGS'	=> 'Settings',
	'UFAQ_CATS_LIST' => 'Category list',
	'UFAQ_STATUS'	=> 'Enable "Answer-Question" MOD',
	'UFAQ_DISABLED'	=> 'Disabled by Administrator',
	'UFAQ_VERSION'	=> 'Version',
	'UFAQ_SELECT'	=> 'System configuration',
	'UFAQ_USERS_SELECT'	=> 'User settings',
	'UFAQ_SET_SAVED'	=> 'UFAQ settings sucessfully saved',
	'UFAQ_USE_RATING'	=> 'Enable ratio system',
	'UFAQ_USE_WATCHING'	=> 'Enable category and topics watching system',
	'UFAQ_USE_AVATAR_QUESTOR'	=> 'Show avatar for author question',
	'UFAQ_USE_AVATAR_ANSWER'	=> 'Show avatars answered users',
	'UFAQ_TOOLTIP_LEN'	=> 'Tooltips lenght (question, last answers)',
	'UFAQ_GUEST_PREMODE'	=> 'Moderation questions from guests',
	'UFAQ_GUEST_PREMODE_EXPLAIN'	=> 'If enabled, all new questions from unregistered users will automatically be placed on moderation, they will not perform the ratings, response and subscription.',
	'UFAQ_SEARCH_ANSWERED'		=> 'Answered',
	'UFAQ_CATS_COUNT'	=> 'Categoryes',

	'UFAQ_MOD_OPEN'	=>	'Open topic',
	'UFAQ_MOD_CLOSE'	=> 'Finally close topic',
	'UFAQ_MOD_CLOSE_MODERATION'	=> 'Turn to Moderation',
	'UFAQ_MOD_MOVE'	=>	'Move topic',
	'UFAQ_IN'	=> 'to',

	'UFAQ_MOD_OPENED'	=> 'Topic opened',
	'UFAQ_MOD_MOVED'	=> 'Topic moved',	
	'UFAQ_MOD_CLOSED'	=> 'Topic closed. Answering, watching and rating is disabled.',
	'UFAQ_MOD_PREMODERATION'	=> 'Premoderation... Answering, watching and rating is disabled.',
	'USER_NAME'               	=> 'If you need to enter any name here',
	'USER_NAME_ABS'				=> 'Be sure to include your name',
	'USER_SECORITE'            	=> 'Hide me under the specified nickname',
	'GUEST'                   	=> 'UFAQ Guest',
	'UFAQ_OUTSIDE_LINK'	=> 'Link to Question',
	'UFAQ_OUTSIDE_LINK_EXPLAIN'	=> 'Use one of these links for publication in the forum or chat. <br> Recipient will be immediately ask a question, choose the desired partition. ',
));
?>