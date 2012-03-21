<?php
/** 
* I'm request you retain the copyright notice below including the link to site author.
*
* info_acp_similar_topics [Russian]
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
	'ACP_SIMILAR_TOPICS'						=> 'Похожие темы',
	'ACP_SIMILAR_TOPICS_EXPLAIN'				=> 'На этой странице вы можете настроить поиск похожих тем.',
	'ACP_SIMILAR_TOPICS_MOD_VERSION'			=> 'Версия МОДа: ',
	'LOG_CONFIG_SIMILAR_TOPICS'					=> '<strong>Редактирование настроек поиска похожих тем.</strong>',
	'TOGGLE_DISPLAY'							=> 'Показать/скрыть',
	
	'SIMILAR_STOPWORDS'							=> 'Исключать стоп-слова',
	'SIMILAR_IGNORE_FORUMS'						=> 'Игнорируемые форумы',
	'SIMILAR_IGNORE_FORUMS_EXPLAIN'				=> 'Отметьте форумы, в которых поиск похожих тем будет игнорироваться (например тестовый форум, форум для трепа и т.д.).',
	'SIMILAR_NOSHOW_FORUMS'						=> 'Не показывать в форумах',
	'SIMILAR_NOSHOW_FORUMS_EXPLAIN'				=> 'Отметьте форумы, в которых список похожих тем показывать не надо.',
	
	'SIMILAR_SORT_TYPE'							=> 'Сортировать темы',
	'SIMILAR_SORT_TYPE_EXPLAIN'					=> 'Выберите метод сортировки похожих тем',
	'SIMILAR_SORT_DATE'							=> 'по времени сообщения',
	'SIMILAR_SORT_RELEV'						=> 'по релевантности',
	'SIMILAR_MAX_TOPICS'						=> 'Максимальное количество тем для показа',
	'SIMILAR_POSTING'							=> 'Включить поиск при создании новой темы',
	'SIMILAR_VIEWTOPIC'							=> 'Показывать список на странице просмотра темы',
	'SIMILAR_MIN_AMOUNT_WORDS_VIEWTOPIC'		=> 'Мин. количество слов (для страницы темы).<br />Установите 0, если не требуется',
	'SIMILAR_MIN_AMOUNT_WORDS_VIEWTOPIC_EXPLAIN'=> 'Минимальное количество слов в заголовке темы для вывода похожих тем.',
	'SIMILAR_MIN_AMOUNT_WORDS_POSTING'			=> 'Мин. количество слов (при создании темы).<br />Установите 0, если не требуется',
	'SIMILAR_MIN_AMOUNT_WORDS_POSTING_EXPLAIN'	=> 'Минимальное количество слов в названии темы для вывода похожих тем.',
	'SIMILAR_MIN_RELEVANCE'						=> 'Минимальная релевантность.<br />Установите 0, если не требуется',
	'SIMILAR_MIN_RELEVANCE_EXPLAIN'				=> 'Контролирует релевантность названия темы для вывода похожих тем. Это значение установите опытным путём.',
	'SIMILAR_USE_BOOLEAN_MODE'					=> 'Использовать логический режим поиска',
	'SIMILAR_USE_BOOLEAN_MODE_EXPLAIN'			=> 'Использование поиска без контроля релевантности и 50% пороговой величины.',
	'SIMILAR_USE_CACHE'							=> 'Использовать кэш',
	'SIMILAR_USE_CACHE_EXPLAIN'					=> 'Использование кэша phpBB для хранения результатов поиска похожих тем при просмотре темы.',
	'SIMILAR_USE_CACHE_TIME'					=> 'Время хранения в кэше (сек.)',
	'SIMILAR_USE_CACHE_TIME_EXPLAIN'			=> 'Время хранения результатов поиска в кэше. По умолчанию 3600 с.',

	'SIMILAR_TOPICDESC'		=> 'Учитывать описание темы <br />(при установленном моде Topic Description)',
	
// Install block
	'INSTALLED'				=> 'Мод поиска похожих тем успешно <strong>установлен</strong>.',
	'NO_FILES_MODIFIED'		=> 'Вы не внесли изменения в файлы в соответствии с инструкцией по установке мода.',
	'NOT_INSTALLED'			=> 'На вашей конференции не был установлен данный мод поиска похожих тем.',
	'UNINSTALLED'			=> 'Мод похожие темы успешно <strong>удалён</strong> из базы данных.',
));

?>