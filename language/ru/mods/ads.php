<?php
/**
* [Russian]
*
* @package phpBB3 Advertisement Management
* @version $Id: ads.php 92 2009-11-02 16:26:43Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ADVERTISEMENT_MANAGEMENT_CREDITS'		=> 'Объявления <a href="http://www.lithiumstudios.org/">Advertisement Management</a>. Перевод от <a href="http://fladex.ru/">FladeX</a>',
	'MY_ADS'								=> 'Мои объявления',

	// Default Positions
	'ABOVE_FOOTER'			=> 'Над подвалом',
	'ABOVE_HEADER'			=> 'Над шапкой',
	'ABOVE_POSTS'			=> 'Над сообщениями',
	'AFTER_EVERY_POST'		=> 'После каждого сообщения, кроме первого',
	'AFTER_FIRST_POST'		=> 'После первого сообщения',
	'BELOW_FOOTER'			=> 'Под подвалом',
	'BELOW_HEADER'			=> 'Под шапкой',
	'BELOW_POSTS'			=> 'Под сообщениями',

	// ACP
	'0_OR_NA'									=> '0 или N/A',

	'ACP_ADVERTISEMENT_MANAGEMENT_EXPLAIN'		=> 'Здесь вы можете изменить настройки Advertisement Management, добавить/удалить/изменить рекламную площадку, и добавить/удалить/изменить объявления.',
	'ACP_ADVERTISEMENT_MANAGEMENT_SETTINGS'		=> 'Настройки Advertisement Management',
	'ADS_ACCURATE_VIEWS'						=> 'Точный подсчёт просмотров',
	'ADS_ACCURATE_VIEWS_EXPLAIN'				=> 'Подсчёт показов оъявлений будет более точным, но при этом возрастёт нагрузка на сервер.',
	'ADS_COUNT_CLICKS'							=> 'Подсчёт кликов по объявлениям',
	'ADS_COUNT_CLICKS_EXPLAIN'					=> 'При отключении этой опции, клики по объявлениям не будут считаться (нагрузка на сервер будет меньше).',
	'ADS_COUNT_VIEWS'							=> 'Подсчёт показов объявлений',
	'ADS_COUNT_VIEWS_EXPLAIN'					=> 'При отключении этой опции, показы объявлений считаться не будут (нагрузка на сервер будет меньше).',
	'AD_CREATED'								=> 'Объявление создано',
	'ADS_ENABLE'								=> 'Включить объявления',
	'ADS_GROUP'									=> 'Группа владельцев объявлений',
	'ADS_GROUP_EXPLAIN'							=> 'Будет добавлена группа владельцев объявлений (необязательная опция, устанавливайте только в случае, когда вам действительно нужно выделить их в отдельную группу).',
	'ADS_RULES_FORUMS'							=> 'Использовать форумные правила для объявлений',
	'ADS_RULES_FORUMS_EXPLAIN'					=> 'Если включено, то вы сможете контролировать, в каких форумах будет отображаться каждое объявление. Если вы не планируете пользоваться этим, то отключите опцию в целях экономии ресурсов сервера.',
	'ADS_RULES_GROUPS'							=> 'Использовать права доступа групп для объявлений',
	'ADS_RULES_GROUPS_EXPLAIN'					=> 'Если включено, то вы сможете контролировать, какие группы пользователей будут видеть объявления, а какие нет. Если вы не планируете пользоваться этим, то отключите опцию в целях экономии ресурсов сервера.',
	'ADS_VERSION'								=> 'Версия Advertisement Management',
	'ADVERTISEMENT'								=> '',	//Объявление
	'ADVERTISEMENT_MANAGEMENT_UPDATE_SUCCESS'	=> 'Настройки Advertisement Management были успешно обновлены!',
	'AD_ADD_SUCCESS'							=> 'Объявление успешно добавлено!',
	'AD_CLICK_LIMIT'							=> 'Лимит кликов по объявлению',
	'AD_CLICK_LIMIT_EXPLAIN'					=> '0 для отключения, остальные числа устанавливают количество кликов по объявлению, после которых оно будет отключено.',
	'AD_CLICKS'									=> 'Клики по объявлению',
	'AD_CLICKS_EXPLAIN'							=> 'Текущее количество кликов по этому объявлению (при условии правильной установки).',
	'AD_CODE'									=> 'Код объявления',
	'AD_CODE_EXPLAIN'							=> 'Здесь указывается код объявления, которое вы хотите показывать. Все объявления добавляются в html-коде, bb-код не поддерживается.<br /><strong>Если вы хотите подсчитывать количество кликов по объявлению, используйте конструкцию {COUNT_CLICK} в любом месте, где поддерживается аттрибут onclick (например, в теге a).</strong>',
	'AD_EDIT_SUCCESS'							=> 'Объявление успешно изменено!',
	'AD_ENABLED'								=> 'Объявление включено',
	'AD_ENABLED_EXPLAIN'						=> 'Снимите флажок для отключения показа этого объявления.',
	'AD_FORUMS'									=> 'Список форумов',
	'AD_FORUMS_EXPLAIN'							=> 'Выберите форумы, в которых вы хотите показывать данное объявление. Вы можете выбрать несколько форумов, удерживая клавишу CTRL.',
	'AD_GROUPS'									=> 'Группы',
	'AD_GROUPS_EXPLAIN'							=> 'Выберите группы, которым вы <strong>НЕ</strong> хотите показывать объявление. Вы можете выбрать несколько групп, удерживая клавишу CTRL.',
	'AD_LIST_NOTICE'							=> 'Подсчёт кликов будет доступен только при использовании конструкции {COUNT_CLICK} в месте, где поддерживается аттрибут onclick.',
	'AD_MAX_VIEWS'								=> 'Максимальное количество просмотров',
	'AD_MAX_VIEWS_EXPLAIN'						=> 'Максимальное количество просмотров данного объявления, после которого оно перестанет показываться. <strong>0 означает отсутствие ограничения</strong>.',
	'AD_NAME'									=> 'Название объявления',
	'AD_NAME_EXPLAIN'							=> 'Это используется только для идентификации объявления.',
	'AD_NOT_EXIST'								=> 'Выбранное объявление не существует.',
	'AD_NOTE'									=> 'Заметки об объявлении',
	'AD_NOTE_EXPLAIN'							=> 'Укажите любые заметки об этом объявлении. Эти заметки не будут отображаться нигде, кроме администраторского раздела.',
	'AD_OWNER'									=> 'Владелец объявления',
	'AD_OWNER_EXPLAIN'							=> 'Пользователь, являющийся владельцем данного объявления (может видеть его в своей панели объявлений).',
	'AD_POSITIONS'								=> 'Площадки',
	'AD_POSITIONS_EXPLAIN'						=> 'Выберите площадки, в которых вы хотите показывать это объявление.',
	'AD_PRIORITY'								=> 'Приоритет объявления',
	'AD_PRIORITY_EXPLAIN'						=> 'Большее значение соответствует большей вероятности показа объявления. Например, объявление с приоритетом 2 будет показываться в два раза чаще, чем объявление с приоритетом 1, а объявление с приоритетом 3 уже в три раза чаще, и так далее.',
	'AD_TIME_END'								=> 'Актуально до',
	'AD_TIME_END_BEFORE_NOW'					=> 'Время окончания, которое вы ввели, соответствует прошедшому времени. Пожалуйста, убедитесь, что вы ввели время, совместимое с strtotime.',
	'AD_TIME_END_EXPLAIN'						=> 'Введите корректную дату для окончания показа объявления. После указанного времени объявление автоматически перестанет показываться. Убедитесь, что используете PHP-функцию <a href="http://us2.php.net/manual/en/function.strtotime.php">strtotime</a>, чтобы быть уверенным в корректности формата времени.<br /><br /><strong>Время окончания указывается безотносительно часовых поясов и тому подобного, поэтому могут быть небольшие погрешности. В связи с этим рекомендуется при оценке времени округлять все до дней, а не до минут и часов.</strong>',
	'AD_VIEW_LIMIT'								=> 'Лимит просмотров объявления',
	'AD_VIEW_LIMIT_EXPLAIN'						=> '0 для отключения, остальные числа устанавливают количество просмотров объявления, после которых оно будет отключено.',
	'AD_VIEWS'									=> 'Просмотры объявления',
	'AD_VIEWS_EXPLAIN'							=> 'Текущее количество просмотров этого объявления.',
	'ALL_FORUMS_EXPLAIN'						=> 'Выберите для показа во всех форумах и на всех страницах. При неиспользовании этой опции, объявление не будет показываться на не-форумных страницах (таких как страница FAQ, например).',

	'CREATE_AD'									=> 'Создать объявление',
	'CREATE_POSITION'							=> 'Создать площадку',

	'DELETE_AD'									=> 'Удалить объявление',
	'DELETE_AD_CONFIRM'							=> 'Вы уверены, что хотите удалить это объявление?',
	'DELETE_AD_SUCCESS'							=> 'Объявление было успешно удалено!',
	'DELETE_POSITION'							=> 'Удалить площадку',
	'DELETE_POSITION_CONFIRM'					=> 'Вы уверены, что хотите удалить эту площадку? При удалении площадки, все объявления с этой площадки также перестанут показываться.',
	'DELETE_POSITION_SUCCESS'					=> 'Площадка успешно удалена!',

	'FALSE'										=> 'Нет',

	'NO_ADS_CREATED'							=> 'Нет созданных объявлений',
	'NO_AD_NAME'								=> 'Вы должны задать название для объявления.',
	'NO_POSITIONS_CREATED'						=> 'Нет созданных площадок',

	'POSITION'									=> 'Площадка',
	'POSITION_CODE'								=> 'Код площадки',
	'POSITION_EDIT_SUCCESS'						=> 'Площадка успешно отредактирована!',
	'POSITION_NAME'								=> 'Название площадки',
	'POSITION_NAME_EXPLAIN'						=> 'Название площадки.',
	'POSITION_NOT_EXIST'						=> 'Выбранная площадка не существует.',
	'POSTITION_ADD_SUCCESS'						=> 'Площадка успешно добавлена!',
	'POSTITION_ALREADY_EXIST'					=> 'У вас уже есть площадка с таким названием.',

	'TRUE'										=> 'Да',
));

?>