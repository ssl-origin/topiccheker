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
	/* MODIFICA QUI: PAROLE CON BASSA RILEVANZA */
	/* Separa le parole con virgole */
	'SEBO_TOPICCHECK_STOPWORDS' => 'problema, problem, aiuto, help, info, consiglio, consigli, domanda, errore, bug, test, ciao, salve, urgente, importante, dubbio, opinione, parere, richiesta, cerco, vendo, offro, tutorial, guida, manuale, come, dove, quando, perche, chi, cosa, topic, thread, post, forum, pagina, sito, link, immagine, foto, video, news, novità, aggiornamento, patch, versione, release',
]);
