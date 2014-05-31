<?php
/**
*
* phpBB Shop Auction [Русский]
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
	'acl_u_add_answers'    => array('lang' => 'Может давать ответы на вопросы (UFAQ)', 'cat' => 'misc'),
    'acl_u_add_question'    => array('lang' => 'Может задавать вопросы (UFAQ)', 'cat' => 'misc'),
	'UFAQ'			=> 'Пользовательский FAQ',
	'UFAQ_SUBJ'		    	=> 'Введите здесь заголовок своего вопроса',
	'UFAQ_VIEWS'		=> 'Просмотров',
	'UFAQ_CAT'			=> 'Раздел',
	'UFAQ_CATS'			=> 'Конфигурация',
	'UFAQ_COUNT'			=> 'Вопросов',
	'UFAQ_LAST_Q'			=> 'Последний вопрос',
	'UFAQ_LAST_A'			=> 'Последний ответ',
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
	'UFAQ_RATE_Q'		=> 'Хорошая тема или вопрос',
	'UFAQ_RATE_Q_MINUS'		=> 'Бесполезная мысль',
	'UFAQ_RATE_A'		=> 'Этот ответ мне помог',
	'UFAQ_RATE_A_MINUS'		=> 'Это бесполезный ответ',
	'UFAQ_RATED'		=> 'Спасибо, Ваш голос учтен!<br /><br /><a href="%1$s">Вернуться к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_ALREDY_RATED'		=> 'Вы уже голосовали!',
	'UFAQ_PM_SUBJECT'		=> 'На Ваш вопрос...',
	'UFAQ_PM_MESSAGE'		=> 'Вы можете прочитать его перейдя по ссылке ниже.<br /><a href="%1$s">%2$s</a>',

	'ACP_ADD_CAT'			=> 'Добавить раздел',
	'ACP_CAT_EDITING'			=> 'Редактировать раздел',
	'ACP_NO_CATNAME'			=> 'Не указано название раздела!',
	'CAT_ADDED'				=> 'Добавлен раздел ',
	'CAT_EDITED'				=> 'Отредактирован раздел ',
	'CAT_DELETED'			=> 'Раздел и все содержащиеся в нем вопросы удалены успешно',

	// Версия 1.0.2
	'UFAQ_CAT_IMG'		=> 'Иконка раздела',
	'UFAQ_CAT_IMG_EXPLAIN'		=> 'Выберите файл изображения раздела. Файлы должны находиться в папке <b>/images/ufaq/</b>',
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
	'UFAQ_WATCH_EXP'		=> 'Вы будете уведомляться по ЛС о каждом ответе',
	'UFAQ_PM_SUBJ_WATCH'	=> 'Ответ...',
	'UFAQ_UNWATCH'		=> 'Отписаться от темы',
	'UFAQ_PM_MESSAGE_WATCH'		=> 'Добавлен новый ответ к вопросу на который Вы подписались.<br />Вы можете прочитать его перейдя по ссылке ниже.<br /><a href="%1$s">%2$s</a>',
	'UFAQ_ALREDY_WATCH'		=> 'Вы уже подписаны на ответы к этому вопросу!',
	'UFAQ_ALREDY_UNWATCH'		=> 'Вы не подписывались',
	'UFAQ_WATCH_SELF'	=> 'Вы автор этого вопроса, включить подписку можно при редактировании вопроса.',
	'UFAQ_WATCHED'		=> 'Вы успешно подписались на ответы к этому вопросу!<br /><br /><a href="%1$s">Вернуться к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_UNWATCHED'		=> 'Вы успешно отписались от ответов на этот вопрос!<br /><br /><a href="%1$s">Вернуться к вопросу</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	
	'UFAQ_CAT_WATCH'		=> 'Подписаться на категорию',
	'UFAQ_CAT_WATCH_EXP'		=> 'Вы будете уведомляться по ЛС о каждом вопросе',
	'UFAQ_CAT_UNWATCH'		=> 'Отписаться от категории',
	'UFAQ_CAT_UNWATCH_EXP'		=> 'Уведомление о новых вопросах будет прекращено',
	'UFAQ_CAT_WATCHED'		=> 'Вы успешно подписались на новые вопросы в этой категории.<br /><br /><a href="%1$s">Вернуться к списку категорий</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_CAT_UNWATCHED'		=> 'Вы успешно отписались от этой категории.<br /><br /><a href="%1$s">Вернуться к списку категорий</a><br /><br /><a href="%2$s">Перейти на главную страницу форума</a>',
	'UFAQ_CAT_ALREDY_WATCH'		=> 'Вы уже подписаны на эту категорию',
	'UFAQ_CAT_ALREDY_UNWATCH'		=> 'Вы ещё не подписывались на категорию',
	'UFAQ_CAT_PM_SUBJ_WATCH'	=> 'Вопросы...',
	'UFAQ_CAT_PM_MESSAGE_WATCH'		=> 'Добавлен новый вопрос в категории, на которую вы подписались.<br />Вы можете посмотреть его перейдя по ссылке ниже.<br /><a href="%1$s">%2$s</a>',
	
	'UFAQ_SETTINGS'	=> 'Параметры',
	'UFAQ_CATS_LIST' => 'Список Разделов',
	'UFAQ_STATUS'	=> 'Включить МОД "Вопросы-ответы"',
	'UFAQ_DISABLED'	=> 'Система отключена администратором',
	'UFAQ_VERSION'	=> 'Версия',
	'UFAQ_SELECT'	=> 'Настройки системы',
	'UFAQ_USERS_SELECT'	=> 'Пользовательские настройки',
	'UFAQ_SET_SAVED'	=> 'Настройки UFAQ успешно сохранены',
	'UFAQ_USE_RATING'	=> 'Включить систему рейтингов',
	'UFAQ_USE_WATCHING'	=> 'Включить систему подписок на категории и ответы',
	'UFAQ_USE_AVATAR_QUESTOR'	=> 'Показывать аватар пользователя, автора вопроса',
	'UFAQ_USE_AVATAR_ANSWER'	=> 'Показывать аватары ответивших пользователей',
	'UFAQ_TOOLTIP_LEN'	=> 'Длина текста подсказок (вопрос, последние ответы)',
	'UFAQ_GUEST_PREMODE'	=> 'Премодерация вопросов от Гостей',
	'UFAQ_GUEST_PREMODE_EXPLAIN'	=> 'Если включено, то все новые вопросы от незарегистрированных пользователей автоматически будут поставлены на модерацию, в них будут недоступны функции рейтингов, ответа, подписки.',
	'UFAQ_SEARCH_ANSWERED'		=> 'Вопросы с ответами',
	'UFAQ_CATS_COUNT'	=> 'Разделов',

	'UFAQ_MOD_OPEN'	=>	'Открыть тему',
	'UFAQ_MOD_CLOSE'	=> 'Совсем закрыть тему',
	'UFAQ_MOD_CLOSE_MODERATION'	=> 'Отправить на премодерацию',
	'UFAQ_MOD_MOVE'	=>	'Переместить тему',
	'UFAQ_IN'	=> 'в',

	'UFAQ_MOD_OPENED'	=> 'Тема открыта',
	'UFAQ_MOD_MOVED'	=> 'Тема перемещена',
	'UFAQ_MOD_CLOSED'	=> 'Тема закрыта. Ответы, голосование и подписка недоступны.',
	'UFAQ_MOD_PREMODERATION'	=> 'Тема находится на Премодерации. Ответы, голосование и подписка пока недоступны.',
	'USER_NAME'               	=> 'Введите здесь любое имя, если это вам необходимо',
	'USER_NAME_ABS'				=> 'Обязательно укажите ваше имя',
	'USER_SECORITE'            	=> 'Скрыть меня под указанным ником',
	'GUEST'                   	=> 'UFAQ Гость',
	'UFAQ_OUTSIDE_LINK'	=> 'Прямая ссылка для Вопроса',
	'UFAQ_OUTSIDE_LINK_EXPLAIN'	=> 'Используйте одну из этих ссылок для публикации в форуме или в чате.<br> Получатель ссылки сможет сразу задать вопрос, выбрав нужный Раздел.',
));
?>