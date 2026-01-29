<?php

/**
 *
 * sebo-topiccheck. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026, sebo, https://www.fiatpandaclub.org
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace sebo\topiccheck\controller;

use phpbb\console\command\user\add;

/**
 * TopicCheck ACP controller.
 */
class acp_controller
{
	protected $language;
	protected $request;
	protected $template;
	protected $user;
	protected $table_prefix;
	protected $db;
	protected $u_action;

	public function __construct(
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\user $user,
		$table_prefix,
		\phpbb\db\driver\driver_interface $db
	)
	{
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->table_prefix = $table_prefix;
		$this->db = $db;
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}

	public function display_options($mode)
	{
		$this->language->add_lang('info_acp_module', 'sebo/topiccheck');

		// Assegna il link donazione globale per tutti i template
		$this->template->assign_var('LINK_DONATE', 'https://www.paypal.com/donate/?hosted_button_id=GS3T9MFDJJGT4');

		// ---------------------------------------------------------------------
		// MODE: SETTINGS
		// ---------------------------------------------------------------------
		if ($mode == 'settings')
		{
			// 1. Genera la chiave di sicurezza
			add_form_key('acp_topiccheck_settings');

			if ($this->request->is_set_post('submit'))
			{
				// 2. Controlla la chiave (CORRETTO: usa check_form_key, non check_link_hash)
				if (!check_form_key('acp_topiccheck_settings'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// 3. Recupera l'array dei forum selezionati
				$selected_forums = $this->request->variable('forum_ids', [0]);

				// 4. Pulisci la tabella
				$sql = 'DELETE FROM ' . $this->table_prefix . 'sebo_topiccheck_forums';
				$this->db->sql_query($sql);

				// 5. Inserisci i nuovi dati (se ce ne sono)
				if (!empty($selected_forums))
				{
					$sql_ary = [];
					foreach ($selected_forums as $f_id)
					{
						$sql_ary[] = [
							'forum_id' => (int) $f_id,
							'active'   => 1,
						];
					}
					$this->db->sql_multi_insert($this->table_prefix . 'sebo_topiccheck_forums', $sql_ary);
				}

				trigger_error($this->language->lang('ACP_TOPICCHECK_SETTINGS_SAVED') . adm_back_link($this->u_action));
			}

			// Logica visualizzazione forum
			$sql = 'SELECT f.forum_id, f.forum_name, f.parent_id, f.left_id, tf.active
					FROM ' . FORUMS_TABLE . ' f
					LEFT JOIN ' . $this->table_prefix . 'sebo_topiccheck_forums tf ON f.forum_id = tf.forum_id
					ORDER BY f.left_id ASC';

			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$this->template->assign_block_vars('forums', [
					'ID'       => $row['forum_id'],
					'NAME'     => $row['forum_name'],
					'S_ACTIVE' => ($row['active'] == 1),
					'IS_CHILD' => ($row['parent_id'] > 0),
				]);
			}
			$this->db->sql_freeresult($result);

			$this->template->assign_vars([
				'U_ACTION' => $this->u_action,
			]);
		}

		// ---------------------------------------------------------------------
		// MODE: WORDS
		// ---------------------------------------------------------------------
		else if ($mode == 'words')
		{
			// 1. Generate the form key (shared for both forms on this page)
			add_form_key('acp_topiccheck_words');
			// -------------------------------------------------------------
			// LOGIC: ADD NEW LANGUAGE (New Form)
			// -------------------------------------------------------------
			if ($this->request->is_set_post('add_language'))
			{
				// Check form key validity
				if (!check_form_key('acp_topiccheck_words'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Retrieve the selected language from the dropdown
				$new_lang_iso = $this->request->variable('language', '');

				// Validate: Ensure a language was actually selected
				if (empty($new_lang_iso))
				{
					trigger_error($this->language->lang('NO_LANGUAGE_SELECTED') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Validate: Check if language already exists in the database
				$sql_ary = [
					'SELECT'	=> 'lang_iso',
					'FROM'		=> [
						$this->table_prefix . 'sebo_topiccheck_words' => 'stw',
					],
					'WHERE'		=> "lang_iso = '" . $this->db->sql_escape($new_lang_iso) . "'",
				];
				$sql = $this->db->sql_build_query('SELECT', $sql_ary);
				$result = $this->db->sql_query($sql);
				$exists = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if ($exists)
				{
					// Language already exists, warn the user
					trigger_error($this->language->lang('LANGUAGE_ALREADY_EXISTS') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Insert the new language with an empty word list
				$sql_ary = [
					'lang_iso'	=> $new_lang_iso,
					'word_list'	=> '', // Empty by default
				];

				$sql = 'INSERT INTO ' . $this->table_prefix . "sebo_topiccheck_words " . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->db->sql_query($sql);

				// Success message
				trigger_error($this->language->lang('LANGUAGE_ADDED_SUCCESS') . adm_back_link($this->u_action));
			}

			// -------------------------------------------------------------
			// LOGIC: SAVE WORDS (Existing Form)
			// -------------------------------------------------------------

			// Set default selected language based on request or default to 'en'
			$selected_lang = $this->request->variable('lang_iso', 'en');

			if ($this->request->is_set_post('save_words'))
			{
				if (!check_form_key('acp_topiccheck_words'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$words_input = $this->request->variable('words_list', '', true);
				$words_input = str_replace(["\r\n", "\r", "\n"], ',', $words_input);

				// Database Logic
				// Check if the selected language exists in the words table
				$sql_ary = [
					'SELECT'	=> 'lang_iso',
					'FROM'		=> [
						$this->table_prefix . 'sebo_topiccheck_words' => 'stw',
					],
					'WHERE'		=> "lang_iso = '" . $this->db->sql_escape($selected_lang) . "'",
				];

				$sql = $this->db->sql_build_query('SELECT', $sql_ary);
				$result = $this->db->sql_query($sql);
				$exists = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if ($exists)
				{
					$sql_ary = ['word_list' => $words_input];
					$sql = 'UPDATE ' . $this->table_prefix . "sebo_topiccheck_words SET " . $this->db->sql_build_array('UPDATE', $sql_ary) . " WHERE lang_iso = '" . $this->db->sql_escape($selected_lang) . "'";
				}
				else
				{
					$sql_ary = ['lang_iso' => $selected_lang, 'word_list' => $words_input];
					$sql = 'INSERT INTO ' . $this->table_prefix . "sebo_topiccheck_words " . $this->db->sql_build_array('INSERT', $sql_ary);
				}
				$this->db->sql_query($sql);

				trigger_error($this->language->lang('ACP_TOPICCHECK_SETTINGS_SAVED') . adm_back_link($this->u_action));
			}

			// -------------------------------------------------------------
			// VIEW LOGIC (Prepare Template)
			// -------------------------------------------------------------

			$current_lang = $this->user->lang_name;

			// Fetch available languages
			$available_langs = [];
			$sql_ary = [
				'SELECT'	=> 'lang_iso',
				'FROM'		=> [
					$this->table_prefix . 'sebo_topiccheck_words' => 'stw',
				],
			];

			$sql = $this->db->sql_build_query('SELECT', $sql_ary);
			$sql .= ' ORDER BY lang_iso ASC';

			$result = $this->db->sql_query($sql);
			while ($row = $this->db->sql_fetchrow($result))
			{
				$available_langs[] = $row['lang_iso'];
			}
			$this->db->sql_freeresult($result);

			// Check if the database is empty (no languages at all)
			if (empty($available_langs))
			{
				$this->template->assign_vars([
					'TOPICCHECK_LANGUAGE_MISSING'	=> true,
				]);
			}
			// Check if the user's current language is not in the available list
			else if (!in_array($current_lang, $available_langs))
			{
				$this->template->assign_vars([
					'TOPICCHECK_YOUR_LANGUAGE_MISSING'	=> true,
				]);
			}

			$s_lang_options = '';
			foreach ($available_langs as $iso)
			{
				$selected = ($iso == $selected_lang) ? ' selected="selected"' : '';
				$s_lang_options .= '<option value="' . $iso . '"' . $selected . '>' . strtoupper($iso) . '</option>';
			}

			// Fetch words
			$current_words = '';
			$sql_ary = [
				'SELECT'	=> 'word_list',
				'FROM'		=> [
					$this->table_prefix . 'sebo_topiccheck_words' => 'stw',
				],
				'WHERE'		=> "lang_iso = '" . $this->db->sql_escape($selected_lang) . "'",
			];

			$sql = $this->db->sql_build_query('SELECT', $sql_ary);
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);
			if ($row)
			{
				$current_words = $row['word_list'];
			}

			$this->template->assign_vars([
				'U_ACTION'		 => $this->u_action,
				'S_LANG_OPTIONS' => $s_lang_options,
				'WORDS_LIST'	 => $current_words,
			]);
		}
	}
}
