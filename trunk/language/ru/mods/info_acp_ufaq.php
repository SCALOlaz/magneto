<?php
/**
*
* phpBB Shop Auction [Русский]
*
* @package language
* @version 1.0.3 $
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
	'acl_u_add_answers'    => array('lang' => 'Может давать ответы на вопросы', 'cat' => 'misc'),
    'acl_u_add_question'    => array('lang' => 'Может задавать вопросы', 'cat' => 'misc'),
	'UFAQ'			=> 'Пользовательский FAQ',
	'UFAQ_SUBJ'			=> 'Заголовок вопроса',
	'UFAQ_VIEWS'		=> 'Просмотров',
	'UFAQ_CAT'			=> 'Раздел',
	'UFAQ_CATS'			=> 'Разделы',
	'UFAQ_COUNT'			=> 'Вопросов',
	'UFAQ_LAST_Q'			=> 'Последний вопрос',
	'UFAQ_EMPTY_CAT'		=> 'Вопросов нет',
	'UFAQ_EMPTY_Q'		=> 'На этот вопрос пока нет ответов',
	'UFAQ_NAME'			=> 'Вопрос',
	'UFAQ_RATING'			=> 'Рейтинг',
	'UFAQ_ANSWERS'			=> 'Ответов',
	'UFAQ_ANSWERS_V'		=> 'Ответы',
	'UFAQ_QUESTOR'			=> 'Спросил',
	'UFAQ_ADD_QUEST'		=> 'Задать вопрос',
	'UFAQ_ADD_ANSWER'		=> 'Ответить на вопрос',
	'UFAQ_ADD_ANSWERS'		=> 'Вопросы и ответы',
	'UFAQ_NO_CAT'		=> 'Выбранного раздела не существует',
	'UFAQ_NO_QUEST'		=> 'Выбранного вопроса не существует или он удален',
	'UFAQ_NO_ANSWER'		=> 'Не указан ответ!',
	'UFAQ_NO_QUESTION'		=> 'Не указан вопрос!',
	'UFAQ_NO_SUBJ'		=> 'Не указан заголовок!',
	'UFAQ_NO_PERMISSION'		=> 'У вас нет прав на это действие!',
	'UFAQ_ANSWER_ADDED'		=> 'Ответ успешно добавлен!<br /><br /><a href="%1$s">Перейти на страницу вопроса</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_ANSWER_DELETED'		=> 'Ответ успешно удален!<br /><br /><a href="%1$s">Перейти на страницу вопроса</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_QUESTION_ADDED'		=> 'Вопрос успешно добавлен!<br /><br /><a href="%1$s">Перейти к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_QUESTION_DELETED'		=> 'Вопрос успешно удален!<br /><br /><a href="%1$s">Перейти на страницу раздела</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_QUESTION_EDITED'		=> 'Успешно изменено!<br /><br /><a href="%1$s">Перейти к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_EDIT'		=> 'Изменить',
	'UFAQ_RATE'		=> 'Голосовать',
	'UFAQ_RATE_SELF'		=> 'Вы не можете голосовать за себя!',
	'UFAQ_RATING'		=> 'Рейтинг',
	'UFAQ_RATE_Q'		=> 'Меня тоже интересует этот вопрос',
	'UFAQ_RATE_A'		=> 'Этот ответ мне помог',
	'UFAQ_RATED'		=> 'Спасибо, Ваш голос учтен!<br /><br /><a href="%1$s">Вернуться к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_ALREDY_RATED'		=> 'Вы уже голосовали!',
	'UFAQ_PM_SUBJECT'		=> 'На Ваш вопрос получен новый ответ',
	'UFAQ_PM_MESSAGE'		=> 'Вы можете прочитать его перейдя по ссылке ниже.<br /><a href="%1$s">%2$s</a>',

	'ACP_ADD_CAT'			=> 'Добавить раздел',
	'ACP_CAT_EDITING'			=> 'Редактировать раздел',
	'ACP_NO_CATNAME'			=> 'Не указано название раздела!',
	'CAT_ADDED'				=> 'Добавлен раздел ',
	'CAT_EDITED'				=> 'Отредактирован раздел ',
	'CAT_DELETED'			=> 'Раздел и все содержащиеся в нем вопросы удалены успешно',

	// Версия 1.0.2
	'UFAQ_CAT_IMG'		=> 'Иконка раздела',
	'UFAQ_CAT_IMG_EXPLAIN'		=> 'Введите имя файла изображения раздела. Файл должен находиться в папке <b>/images/ufaq/</b>',
	'UFAQ_CAN_QUEST'		=> 'Вы <b>можете</b> задавать вопросы',
	'UFAQ_CANT_QUEST'		=> 'Вы <b>не можете</b> задавать вопросы',
	'UFAQ_CAN_ANSWER'		=> 'Вы <b>можете</b> отвечать на вопросы',
	'UFAQ_CANT_ANSWER'		=> 'Вы <b>не можете</b> отвечать на вопросы',

	// Версия 1.0.3
	'UFAQ_NO_RESULT'		=> 'Не указано что искать',
	'UFAQ_NO_SEARCH_RESULT'		=> 'Ничего не найдено',
	'UFAQ_SEARCH_TOP'		=> 'Популярные вопросы',
	'UFAQ_SEARCH_NEW'		=> 'Вопросы без ответов',
	'UFAQ_WATCH'		=> 'Подписаться на ответы',
	'UFAQ_WATCH_EXP'		=> 'Вы будете уведомляться по ЛС о каждом ответе на этот вопрос',
	'UFAQ_PM_SUBJ_WATCH'	=> 'Новый ответ на вопрос',
	'UFAQ_PM_MESSAGE_WATCH'		=> 'Добавлен новый ответ к вопросу на который Вы подписались.<br />Вы можете прочитать его перейдя по ссылке ниже.<br /><a href="%1$s">%2$s</a>',
	'UFAQ_ALREDY_WATCH'		=> 'Вы уже подписаны на ответы к этому вопросу!',
	'UFAQ_WATCH_SELF'	=> 'Вы автор этого вопроса, включить подписку можно при редактировании вопроса.',
	'UFAQ_WATCHED'		=> 'Вы успешно подписались на ответы к этому вопросу!<br /><br /><a href="%1$s">Вернуться к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
));
?>