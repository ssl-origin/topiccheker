<?php

/**
 *
 * sebo-topiccheck. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026, sebo, https://www.fiatpandaclub.org
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace sebo\topiccheck\migrations;

class install_data extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\sebo\topiccheck\migrations\install_schema'];
	}

	public function update_data()
	{
		return [
			['custom', [[$this, 'insert_default_words']]],
		];
	}

	public function insert_default_words()
	{
		// Define full lists as strings
		$words_en = 'problem, issue, error, bug, help, support, question, query, info, advice, tip, guide, tutorial, manual, howto, urgent, important, request, looking, need, want, sell, buy, offer, trade, best, new, update, news, patch, release, version, topic, thread, post, forum, website, link, image, photo, video, review, feedback, solved';

		$words_it = 'problema, problem, aiuto, help, info, consiglio, consigli, domanda, errore, bug, test, ciao, salve, urgente, importante, dubbio, opinione, parere, richiesta, cerco, vendo, offro, tutorial, guida, manuale, come, dove, quando, perche, chi, cosa, topic, thread, post, forum, pagina, sito, link, immagine, foto, video, news, novità, aggiornamento, patch, versione, release';

		$sql_ary = [
			[
				'lang_iso'  => 'en',
				'word_list' => $words_en,
			],
			[
				'lang_iso'  => 'it',
				'word_list' => $words_it,
			],
		];

		// Insert multiple rows
		$this->db->sql_multi_insert($this->table_prefix . 'sebo_topiccheck_words', $sql_ary);
	}
}
