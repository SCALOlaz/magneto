<?php
/**
*
* @package phpBB3
* @version $Id: topic_text_hover.php,v 1.3 2008/12/51 12:20:27 rmcgirr83 Exp $
* @copyright (c) Rich McGirr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
// define constants
if (!defined('TOPIC_TEXT_HOVER_BOTH'))
{
	define('TOPIC_TEXT_HOVER_BOTH', 0);
}
if (!defined('TOPIC_TEXT_HOVER_FIRST'))
{
	define('TOPIC_TEXT_HOVER_FIRST', 1);
}
if (!defined('TOPIC_TEXT_HOVER_LAST'))
{
	define('TOPIC_TEXT_HOVER_LAST', 2);
}

/**
* Include only once.
*/
if(!function_exists('bbcode_strip'))
{
	function bbcode_strip($text)
	{
			static $RegEx = array();
			static $bbcode_strip = 'flash';
			// html is pretty but it may break the layout of the tooltip...let's
			// remove some common ones from the tip
			$text_html = array('&quot;','&amp;','&#039;','&lt;','&gt;');
			$text = str_replace($text_html,'',$text);
			if (empty($RegEx))
			{
				$RegEx = array('`<[^>]*>(.*<[^>]*>)?`Usi', // HTML code
					'`\[(' . $bbcode_strip . ')[^\[\]]+\].*\[/(' . $bbcode_strip . ')[^\[\]]+\]`Usi', // bbcode to strip
					'`\[/?[^\[\]]+\]`mi', // Strip all bbcode tags
					'`[\s]+`' // Multiple spaces
				);
			}
		return preg_replace($RegEx, ' ', $text );
	}
}
?>