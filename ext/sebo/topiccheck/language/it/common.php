<?php

/**
 *
 * topiccheck. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026, sebo, https://www.fiatpandaclub.org
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	/* Language strings */
	/* >1.0.0 */
	'SEBO_TOPICCHECK_ERROR_MESSAGE' => 'Si è verificato un errore:',
]);
