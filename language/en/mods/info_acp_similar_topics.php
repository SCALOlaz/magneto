<?php
/** 
* I'm request you retain the copyright notice below including the link to site author.
*
* info_acp_similar_topics [English]
*
* @package language
* @version $Id: info_acp_similar_topics.php, v 1.1.0 2010/11/21 01:10:26 Porutchik Exp $
* @copyright (c) 2008-2010 Sergey aka Porutchik, http://forum.aeroion.ru
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

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
// ACP block
	'ACP_SIMILAR_TOPICS'				=> 'Similar Topics',
	'ACP_SIMILAR_TOPICS_EXPLAIN'		=> 'On this page you can configure search of similar topics.',
	'ACP_SIMILAR_TOPICS_MOD_VERSION'	=> 'MOD version: ',
	'LOG_CONFIG_SIMILAR_TOPICS'			=> '<strong>Edited Similar Topics settings</strong>',
	'TOGGLE_DISPLAY'					=> 'Show/Hide',
	
	'SIMILAR_STOPWORDS'					=> 'Excludes stop-words',
	'SIMILAR_IGNORE_FORUMS'				=> 'Ignore these forums',
	'SIMILAR_IGNORE_FORUMS_EXPLAIN'		=> 'Select a forums in which the similar topics will be ignored (for example test forum, forum for talk, etc.).',
	'SIMILAR_NOSHOW_FORUMS'				=> 'Do not display in these forums',
	'SIMILAR_NOSHOW_FORUMS_EXPLAIN'		=> 'Select a forums in which a list of similar topics do not display.',
	
	'SIMILAR_SORT_TYPE'					=> 'Sort by',
	'SIMILAR_SORT_TYPE_EXPLAIN'			=> 'Select sort method the similar topics',
	'SIMILAR_SORT_DATE'					=> 'post time',
	'SIMILAR_SORT_RELEV'				=> 'relevance',
	'SIMILAR_MAX_TOPICS'				=> 'Maximum amount of a topics for display',
	'SIMILAR_POSTING'					=> 'To enable search of similar topics at creation of a new topics',
	'SIMILAR_VIEWTOPIC'					=> 'To enable similar topics in viewtopic',
	'SIMILAR_MIN_AMOUNT_WORDS_VIEWTOPIC'=> 'Min number of words (for viewtopic).<br />Set to 0 for no limit',
	'SIMILAR_MIN_AMOUNT_WORDS_VIEWTOPIC_EXPLAIN'=> 'This control in number of words in the topic title to appear in the similar topics',
	'SIMILAR_MIN_AMOUNT_WORDS_POSTING'	=> 'Min number of words (for posting form).<br />Set to 0 for no limit',
	'SIMILAR_MIN_AMOUNT_WORDS_POSTING_EXPLAIN'=> 'This control in number of words in the topic title to appear in the similar topics',
	'SIMILAR_MIN_RELEVANCE'				=> 'Minimum relevance.<br />Set to 0 for no limit',
	'SIMILAR_MIN_RELEVANCE_EXPLAIN'		=> 'This control a relevance in the topic title to appear in the similar topics. Install this value by an experimental way.',
	'SIMILAR_USE_BOOLEAN_MODE'			=> 'Use boolean mode',
	'SIMILAR_USE_BOOLEAN_MODE_EXPLAIN'	=> 'Using the search without a control of relevance. An important difference between ordinary searches and BOOLEAN MODE searches is that the latter does not apply the 50% limit (so the word can appear in more than half the rows).',
	'SIMILAR_USE_CACHE'					=> 'Use cache',
	'SIMILAR_USE_CACHE_EXPLAIN'			=> 'This option to enable the use of phpBB\'s cache to store similar topics results for view a topic.',
	'SIMILAR_USE_CACHE_TIME'			=> 'Cache time (sec.)',
	'SIMILAR_USE_CACHE_TIME_EXPLAIN'	=> 'Storage time results in a cache. By default 3600 seconds.',

	'SIMILAR_TOPICDESC'					=> 'Take into account the description of a topics <br /> (at installed the Topic Description mod)',
	
// Install block
	'INSTALLED'							=> 'You have successfully <strong>installed</strong> Similar Topics mod.',
	'NO_FILES_MODIFIED'					=> 'You haven\'t modified files in according to Similar Topics MOD installation instruction.',
	'NOT_INSTALLED'						=> 'You have not Similar Topics mod installed.',
	'UNINSTALLED'						=> 'You have successfully <strong>uninstalled</strong> Similar Topics mod from your database.',
));

?>