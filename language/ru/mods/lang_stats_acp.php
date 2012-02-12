<?php
/**
*
* @package phpBB Statistics
* @version $Id: lang_stats_acp.php 58 2009-08-29 22:49:56Z marc1706 $
* @copyright (c) 2009 Marc Alexander(marc1706) www.m-a-styles.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: lang_portal_acp.php included in the Board3 Portal package (www.board3.de)
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

// DEVELOPERS PLEASE NOTE
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	'ACP_STATS_VERSION'								=> '<strong>phpBB Statistics %s</strong>',
	// General
	'ACP_STATS_GENERAL_INFO'						=> 'Общие параметры статистики конференции',
	'ACP_STATS_GENERAL_INFO_EXPLAIN'				=> 'Благодарим за использование нашего модуля статистики конференции.',
	'ACP_STATS_GENERAL_SETTINGS'					=> 'Общие параметры',
	'ACP_STATS_GENERAL_SETTINGS_EXPLAIN'			=> 'Здесь вы можете изменить параметры модуля статистики конференции.',
	'ACP_STATS_ENABLE'								=> 'Включить статистику',
	'ACP_STATS_ENABLE_EXPLAIN'						=> 'Включение или отключение статистики.',
	'ACP_BASIC_BASIC_ENABLE'						=> 'Включить общую статистику',
	'ACP_BASIC_BASIC_ENABLE_EXPLAIN'				=> 'Включение или отключение общей статистики.',
	'ACP_BASIC_ADVANCED_ENABLE'						=> 'Включить расширенную статистику',
	'ACP_BASIC_ADVANCED_ENABLE_EXPLAIN'				=> 'Включение или отключение расширенной статистики.',
	'ACP_BASIC_MISCELLANEOUS_ENABLE'				=> 'Включить прочую статистику',
	'ACP_BASIC_MISCELLANEOUS_ENABLE_EXPLAIN'		=> 'Включение или отключение прочей статистики.',
	'ACP_ACTIVITY_FORUMS_ENABLE'					=> 'Включить статистику активности форумов',
	'ACP_ACTIVITY_FORUMS_ENABLE_EXPLAIN'			=> 'Включение или отключение статистики форумов.',
	'ACP_ACTIVITY_TOPICS_ENABLE'					=> 'Включить статистику активности тем',
	'ACP_ACTIVITY_TOPICS_ENABLE_EXPLAIN'			=> 'Включение или отключение статистики тем.',
	'ACP_ACTIVITY_USERS_ENABLE'						=> 'Включить статистику активности участников',
	'ACP_ACTIVITY_USERS_ENABLE_EXPLAIN'				=> 'Включение или отключение статистики участников.',
	'ACP_CONTRIBUTIONS_ATTACHMENTS_ENABLE'			=> 'Включить статистику вложений',
	'ACP_CONTRIBUTIONS_ATTACHMENTS_ENABLE_EXPLAIN'	=> 'Включение или отключение статистики вложений.',
	'ACP_CONTRIBUTIONS_POLLS_ENABLE'				=> 'Включить статистику опросов',
	'ACP_CONTRIBUTIONS_POLLS_ENABLE_EXPLAIN'		=> 'Включение или отключение статистики опросов.',
	'ACP_PERIODIC_DAILY_ENABLE'						=> 'Включить ежедневную статистику',
	'ACP_PERIODIC_DAILY_ENABLE_EXPLAIN'				=> 'Включение или отключение ежедневной статистики.',
	'ACP_PERIODIC_MONTHLY_ENABLE'					=> 'Включить ежемесячную статистику',
	'ACP_PERIODIC_MONTHLY_ENABLE_EXPLAIN'			=> 'Включение или отключение ежемесячной статистики.',
	'ACP_PERIODIC_HOURLY_ENABLE'					=> 'Включить ежечасную статистику',
	'ACP_PERIODIC_HOURLY_ENABLE_EXPLAIN'			=> 'Включение или отключение ежечасной статистики.',
	'ACP_SETTINGS_BOARD_ENABLE'						=> 'Включить статистику настроек конференции',
	'ACP_SETTINGS_BOARD_ENABLE_EXPLAIN'				=> 'Включение или отключение статистики настроек конференции.',
	'ACP_SETTINGS_PROFILE_ENABLE'					=> 'Включить статистику пользовательских настроек',
	'ACP_SETTINGS_PROFILE_ENABLE_EXPLAIN'			=> 'Включение или отключение статистики пользовательских настроек.',

	// Advanced Stats
	'ACP_BASIC_ADVANCED_INFO'						=> 'Расширенная статистика',
	'ACP_BASIC_ADVANCED_INFO_EXPLAIN'				=> 'Здесь вы можете изменить параметры расширенной статистики конференции.',
	'ACP_BASIC_ADVANCED_SETTINGS'					=> 'Параметры расширенной статистики',
	'ACP_BASIC_ADVANCED_SECURITY'					=> 'Безопасная расширенная статистика',
	'ACP_BASIC_ADVANCED_SECURITY_EXPLAIN'			=> 'При включении опции сведения о версии phpBB и базе данных не будут отображаться.',
	'ACP_BASIC_ADVANCED_PRETEND'					=> 'Симулировать последнюю версию phpBB',
	'ACP_BASIC_ADVANCED_PRETEND_EXPLAIN'			=> 'При включении опции на странице расширенной статистики будет отображаться новейшая установленная версия phpBB.<br /><strong>Примечание:</strong> это будет работать, только если безопасная расширенная статистика отключена. Также, если проверка версии в панели администрирования phpBB не работает, то данная функция так же не будет работать.',

	// Miscellaneous Stats
	'ACP_BASIC_MISCELLANEOUS_INFO'					=> 'Прочая статистика',
	'ACP_BASIC_MISCELLANEOUS_INFO_EXPLAIN'			=> 'Здесь вы можете изменить параметры прочей статистики конференции.',
	'ACP_BASIC_MISCELLANEOUS_SETTINGS'				=> 'Параметры прочей статистики',
	'ACP_BASIC_MISCELLANEOUS_WARNINGS'				=> 'Скрыть статистику предупреждений',
	'ACP_BASIC_MISCELLANEOUS_WARNINGS_EXPLAIN'		=> 'Включение или отключение отображения статистики предупреждений.',
	'ACP_BASIC_MISCELLANEOUS_BBCODES'				=> 'Пересчитать BBCodes и смайлики',
	'ACP_BASIC_MISCELLANEOUS_BBCODES_EXPLAIN'		=> 'Включите эту опцию после добавления или изменения настраиваемых BBCodes, или если вам кажется, что счётчики отображают неверные значения. Опция будет автоматически отключена после синхронизации.',

	// Users Activity Stats
	'ACP_ACTIVITY_USERS_INFO'						=> 'Активность участников конференции',
	'ACP_ACTIVITY_USERS_INFO_EXPLAIN'				=> 'Здесь вы можете изменить параметры статистики пользователей конференции.',
	'ACP_ACTIVITY_USERS_SETTINGS'					=> 'Параметры статистики активности участников',
	'ACP_ACTIVITY_USERS_HIDE_ANONYMOUS'				=> 'Скрыть гостей из статистики самых активных пользователей',
	'ACP_ACTIVITY_USERS_HIDE_ANONYMOUS_EXPLAIN'		=> 'При включении опции гости не будут отображаться статистике самых активных пользователей.',
	));


?>