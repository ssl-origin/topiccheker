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
	/* EDIT HERE: WORDS WITH LOW RELEVANCE */
	/* Separate words with commas */
	'SEBO_TOPICCHECK_STOPWORDS' => 'problem, issue, error, bug, help, support, question, query, info, advice, tip, guide, tutorial, manual, howto, urgent, important, request, looking, need, want, sell, buy, offer, trade, best, new, update, news, patch, release, version, topic, thread, post, forum, website, link, image, photo, video, review, feedback, solved',
]);
