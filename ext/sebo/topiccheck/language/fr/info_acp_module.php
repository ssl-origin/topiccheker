<?php

/**
 *
 * sebo-topiccheck. An extension for the phpBB Forum Software package.
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
	'ACP_TOPICCHECK_TITLE' => 'Topic Checker',
	'PP_ME_PR'				=> 'Achète-moi une bière pour la création de cette extension',
	'PP_ME_EXT_PR'			=> '<label>Faites un don pour cette extension :</label><br><span>Cette extension est entièrement gratuite. C’est un projet sur lequel je passe mon temps pour le plaisir et l’utilisation de la communauté phpBB. Si vous aimez utiliser cette extension, ou si cela a bénéficié à votre forum, veuillez envisager <a href="%s" target="_blank" rel="noreferrer noopener">payer une bière</a>. Ce serait grandement apprécié. Merci de télécharger PostReaction !</span>',
	'PP_ME_EXT_ALT'			=> 'Don via PayPal',
	'ACP_TOPICCHECK_SETTINGS_TITLE'          => 'Topic Checker - Paramètres',
	'ACP_TOPICCHECK_WORDS_TITLE'          => 'Topic Checker - Mots de faible pertinence',
	'ACP_TOPICCHECK_WORDS'          => 'Gérer les mots de faible pertinence',
	'ACP_TOPICCHECK_FORUMS'         => 'Gérer les forums',

	'ACP_TOPICCHECK_FORUMS_EXPLAIN' => 'Sélectionnez les forums où la recherche du vérificateur de sujet doit être active.',
	'ACP_TOPICCHECK_SETTINGS_SAVED' => 'Paramètres du forum enregistrés avec succès.',

	'ACP_TOPICCHECK_ADD_WORD'       => 'Ajouter un nouveau Stopword',
	'L_NO_WORDS_FOUND'              => 'Aucun mot trouvé pour cette langue.',
	'L_DELETE_MARKED'               => 'Delete Marked',

	'WORD'                          => 'Mot',
	'ACP_TOPICCHECK_WORDS_EXPLAIN_TEXTAREA' => 'Les mots d’arrêt de faible pertinence doivent être séparés par une virgule.<br>Ces mots auront une pertinence plus faible dans l’algorithme de recherche que les mots normaux.',
	'TOPICCHECK_LANGUAGE_MISSING_EXPLAIN' => 'No language detected in the database.',
	'TOPICCHECK_YOUR_LANGUAGE_MISSING_EXPLAIN' => 'No low relevance words have been defined for your current language. Please add some words to improve the Topic Checker functionality in your language.',
	'WARNING'					  => 'Warning',
	'TC_WORDS_EXPLAIN'				 => 'Edit low relevance words',
	'TC_WORDS_EXPLAIN_TEXT' => 'These words will have lower relevance in the search algorithm than normal words. They are useful to filter out common words. Without these words, the search results may be less accurate.',
	'LANGUAGE_CHOOSE' => 'Choose Language',
	'LANGUAGE_CHOOSE_EXPLAIN' => 'Select the language for which you want to add low relevance words.',
	'TC_LANG_CREATE_EXPLAIN' => 'Add your forum language to create a new list of low relevance words.',
	'TC_LANG_CREATE' => 'Add a new language',
	'WHAT_IS_TC_FOR' => 'What is Topic Checker for?',
	'WHAT_IS_TC_FOR_EXPLAIN' => '<strong>Topic Checker</strong> helps users avoid creating duplicate topics.<br />While a user is creating a new topic and writing a new title, Topic Checker automatically searches for existing topics with similar titles and shows results in real time.<br />In this way, the user can see if the topic they are about to create has already been treated in the forum, thus reducing the creation of duplicate topics.<br />Every user will use the low relevance words defined for their selected language in their own control panel.',
	'TC_STEP_1_ADD_LANG' => 'Step 1: Add your forum language',
	'TC_STEP_2_CHOOSE_WORDS' => 'Step 2: Add common words, with low relevance in searching topics (optional)',
	'TC_STEP_3_CHOOSE_FORUMS' => 'Step 3: Choose forums where enable Topic Checker',
	'LANGUAGE_ALREADY_EXISTS' => 'The selected language already exists in the database.',
	'LANGUAGE_ADDED_SUCCESS' => 'New language has been added successfully.',
	'NO_LANGUAGE_SELECTED' => 'No language selected.',

]);
