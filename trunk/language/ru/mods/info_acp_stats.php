<?php
/**
*
* @package phpBB Statistics
* @version $Id: info_acp_stats.php 45 2009-06-12 15:08:48Z marc1706 $
* @copyright (c) 2009 Marc Alexander(marc1706) www.m-a-styles.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: info_acp_portal.php included in the Board3 Portal package (www.board3.de)
* @translator: Kastaneda — http://www.teosofia.ru
*/


if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_STATS_INFO'							=> 'Статистика конференции',
	'ACP_STATS_GENERAL_INFO'					=> 'Общие параметры',
	'ACP_BASIC_ADVANCED_INFO'					=> 'Расширенная статистика',
	'ACP_BASIC_MISCELLANEOUS_INFO'				=> 'Прочая статистика',
	'ACP_ACTIVITY_USERS_INFO'					=> 'Статистика участников',
	'ACP_STATS_ADDONS'							=> 'Add-Ons',	
));

?>