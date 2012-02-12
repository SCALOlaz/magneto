<?php
/**
*
* @package phpBB Statistics
* @version $Id: install_stats.php 45 2009-06-12 15:08:48Z marc1706 $
* @copyright (c) 2009 Marc Alexander(marc1706) www.m-a-styles.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translator: Kastaneda — http://www.teosofia.ru
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

$lang = array_merge($lang, array(
	'INSTALL_CONGRATS_EXPLAIN'	=>	'<p>Вы успешно установили модуль «phpBB Statistics %s»!<br/><br/><strong>Теперь удалите, переместите или переименуйте папку «install». Пока эта папка будет присутствовать на сервере, у вас будет доступ только к панели администрирования.</strong></p>',
	'INSTALL_INTRO_BODY'		=>	'Эта программа проведёт вас через весь процесс установки модуля «phpBB Statistics» на вашу конференцию.',

	'MISSING_CONSTANTS'			=>	'До запуска программы установки загрузите на сервер отредактированные файлы, особенно файл /includes/constants.php.',
	'MODULES_CREATE_PARENT'		=>	'Создайте родительский стандартный модуль',
	'MODULES_PARENT_SELECT'		=>	'Выберите родительский модуль',
	'MODULES_SELECT_4ACP'		=>	'Родительский модуль для ACP',
	'MODULES_SELECT_NONE'		=>	'Нет родительского модуля',

	'STAGE_ADVANCED_EXPLAIN'		=>	'Теперь будут созданы модули статистики.',
	'STAGE_CREATE_TABLE_EXPLAIN'	=>	'Необходимые таблицы в базе данных созданы и заполнены базовыми значениями. Перейдите к следующему шагу, чтобы закончить установку модуля «phpBB Statistics».',
	'STAGE_ADVANCED_SUCCESSFUL'		=>	'Модули статистики успешно созданы. Перейдите к следующему шагу для завершения установки.',
	'STAGE_UNINSTALL'				=>	'Удаление',

	'FILES_EXISTS'				=>	'Файл всё ещё существует',
	'FILES_OUTDATED'			=>	'Устаревшие файлы',
	'FILES_OUTDATED_EXPLAIN'	=>	'<strong>Устаревшие файлы</strong> — удалите эти файлы, чтобы избежать проблем с безопасностью.',
	'FILES_CHANGE'				=>	'Файл изменён в текущем выпуске',
	'FILES_CHANGED'				=>	'Изменённые файлы',
	'FILES_CHANGED_EXPLAIN'		=>	'<strong>Изменённые файлы</strong> — убедитесь в том, что вы скопировали изменённые файлы на сервер.',
	'REQUIREMENTS_EXPLAIN'		=>	'Удалите все устаревшие файлы с сервера до начала процесса обновления.',
	'NOT_REQUIREMENTS_EXPLAIN'	=>	'Устаревшие файлы не найдены на сервере — вы можете продолжить процесс обновления.',

	'UPDATE_INSTALLATION'			=>	'Обновление модуля «phpBB Statistics»',
	'UPDATE_INSTALLATION_EXPLAIN'	=>	'Эта опция обновит модуль «phpBB Statistics» до текущей версии.',
	'UPDATE_CONGRATS_EXPLAIN'		=>	'<p>Вы успешно обновили модуль «phpBB Statistics %s»!<br/><br/><strong>Теперь удалите, переместите или переименуйте папку «install». Пока эта папка будет присутствовать на сервере, у вас будет доступ только к панели администрирования.</strong></p>',

	'UNINSTALL_INTRO'				=>	'Добро пожаловать в программу удаления!',
	'UNINSTALL_INTRO_BODY'			=>	'Эта программа проведёт вас через весь процесс удаления модуля «phpBB Statistics» с вашей конференции.',
	'CAT_UNINSTALL'					=>	'Удаление',
	'UNINSTALL_CONGRATS'			=>	'<h1>Модуль «phpBB Statistics» успешно удалён</h1>
										Вы успешно удалили модуль «phpBB Statistics».',
	'UNINSTALL_CONGRATS_EXPLAIN'	=>	'<strong>Теперь удалите, переместите или переименуйте папку «install». Пока эта папка будет присутствовать на сервере, у вас будет доступ только к панели администрирования.<br /><br />После этого не забудьте удалить все файлы, связанные с модулем, а также восстановить все отредактированные вами файлы к исходным файлам.</strong></p>',

	'SUPPORT_BODY'		=>	'Бесплатная поддержка последней версии модуля «phpBB Statistics» доступна для следующих вопросов:</p><ul><li>Установка</li><li>Технические вопросы</li><li>Проблемы с модификацией</li><li>Обновление модуля</li></ul><p>Найти поддержку можно на следующих форумах:</p><ul><li><a href="http://www.m-a-styles.de/">M-A-Styles — Сайт автора модуля Marc Alexander (marc1706)</a></li><li><a href="http://www.phpbb.de/">phpbb.de</a></li><li><a href="http://www.phpbb.com/">phpbb.com</a></li></ul><p>',
	'GOTO_INDEX'		=>	'Перейти на конференцию',
	'GOTO_STATS'		=>	'Перейти на страницу статистики',
));

?>