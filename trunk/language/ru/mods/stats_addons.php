<?php
/**
*
* @package phpBB Statistics
* @version $Id: stats_addons.php 45 2009-06-12 15:08:48Z marc1706 $
* @copyright (c) 2009 Marc Alexander(marc1706) www.m-a-styles.de, (c) TheUniqueTiger - Nayan Ghosh
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: Forum Statistics by TheUniqueTiger - Nayan Ghosh
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


/*	Example:
$lang = array_merge($lang, array(
	'STATS'								=> 'phpBB Statistics',

));
*/

$lang = array_merge($lang, array(
	'STATS_ADDONS_MISCELLANEOUS'	=> 'Прочая статистика',
));
?>