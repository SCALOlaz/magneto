<?php
/** 
* I'm request you retain the copyright notice below including the link to site author.
*
* @package acp
* @version $Id: acp_similar_topics.php, v 1.1.0 2010/11/21 01:10:26 Porutchik Exp $
* @copyright (c) 2008-2010 Sergey aka Porutchik, http://forum.aeroion.ru
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_similar_topics_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_similar_topics',
			'title'		=> 'ACP_SIMILAR_TOPICS',
			'version'	=> '1.1.0',
			'modes'		=> array(
				'similar_topics' => array(
					'title' => 'ACP_SIMILAR_TOPICS', 
					'auth' => 'acl_a_board', 
					'cat' => array('ACP_BOARD_CONFIGURATION')
				),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>