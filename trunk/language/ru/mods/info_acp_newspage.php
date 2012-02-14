<?php

/**
*
* newspage [British English]
*
* @package language
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
	'NEWS_TITLE'				=> 'Страница Новостей',
	'NEWS_CONFIG'				=> 'Конфигурация',

	'NEWS'						=> 'Новости',
	'NEWS_ARCHIVE_PER_YEAR'				=> 'Блок Архива за год',
	'NEWS_ARCHIVE_PER_YEAR_EXPLAIN'		=> 'Отдельный блок годичного Архива',
	'NEWS_ARCHIVE'				=> 'Архив',
	'NEWS_ARCHIVE_OF'			=> 'Архив %s',
	'NEWS_ATTACH_SHOW'			=> 'Показывать вложения',
	'NEWS_ATTACH_SHOW_EXPLAIN'	=> 'Вложения будут показаны на страницах новостей.',
	'NEWS_CAT'					=> 'Категории',
	'NEWS_CAT_SHOW'				=> 'Показывать категории',
	'NEWS_CAT_SHOW_EXPLAIN'		=> 'Выбранные форумы будут отображены в Категориях.',
	'NEWS_CHAR_LIMIT'			=> 'Максимум символов в одной новости на странице новостей',
	'NEWS_CHAR_LIMIT_EXPLAIN'	=> 'Помните: ограничение может нарушить структуру BBCode, а так-же <HTML> тэги.',
	'NEWS_COMMENTS'				=> 'Комментарии',
	'NEWS_FORUMS'				=> 'Выбор форумов-Новостей (используйте CTRL для выбора нескольких тем)',
	'NEWS_GO_TO_TOPIC'			=> 'Ссылка на Тему',
	'NEWS_NONE'					=> 'нет Новостей',
	'NEWS_NUMBER'				=> 'Новостей на страницу',
	'NEWS_PAGES'				=> 'Страниц новостей',
	'NEWS_PAGES_EXPLAIN'		=> 'В Архиве ссылок всегда можно будет просмотреть все новости.',
	'NEWS_POLL'					=> 'Опрос',
	'NEWS_POLL_GOTO'			=> 'Войти в Тему и Проголосовать!',
	'NEWS_POST_BUTTONS'			=> 'Показывать кнопки ответа',
	'NEWS_POST_BUTTONS_EXPLAIN'	=> '(quote, edit, ...)',
	'NEWS_READ_FULL'			=> 'Читать полностью',
	'NEWS_READ_HERE'			=> 'Здесь',
	'NEWS_SAVED'				=> 'настройки сохранены',
	'NEWS_USER_INFO'			=> 'Показывать информацию об авторе Новости',
	'NEWS_USER_INFO_EXPLAIN'	=> '(Аватар, Откуда, ...)',

	'NEWSPAGE'					=> 'Страница Новостей',
	'INSTALL_NEWSPAGE'			=> 'Установка Страницы Новостей',
	'INSTALL_NEWSPAGE_CONFIRM'	=> 'Вы уверены что хотите установить этот Модуль?',
	'UPDATE_NEWSPAGE'			=> 'Обновление Модуля',
	'UPDATE_NEWSPAGE_CONFIRM'	=> 'Вы точно хотите обновить Модуль?',
	'UNINSTALL_NEWSPAGE'		=> 'Удаление Модуля Новостей',
	'UNINSTALL_NEWSPAGE_CONFIRM'	=> 'Вам не понравилось и хотите удалить Модуль?',
));

?>