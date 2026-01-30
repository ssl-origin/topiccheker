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

	'ACP_TOPICCHECK_ADD_WORD'       => 'Ajouter un nouveau mot d‘arrêt',
	'L_NO_WORDS_FOUND'              => 'Aucun mot trouvé pour cette langue.',
	'L_DELETE_MARKED'               => 'Delete Marked',

	'WORD'                          => 'Mot',
	'ACP_TOPICCHECK_WORDS_EXPLAIN_TEXTAREA' => 'Les mots d’arrêt de faible pertinence doivent être séparés par une virgule.<br>Ces mots auront une pertinence plus faible dans l’algorithme de recherche que les mots normaux.',
	'TOPICCHECK_LANGUAGE_MISSING_EXPLAIN' => 'Aucune langue détectée dans la base de données.',
	'TOPICCHECK_YOUR_LANGUAGE_MISSING_EXPLAIN' => 'Aucun mot de faible pertinence n’a été défini pour votre langue actuelle. Veuillez ajouter quelques mots pour améliorer la fonctionnalité du vérificateur de sujets dans votre langue..',
	'WARNING'					  => 'Mise en garde',
	'TC_WORDS_EXPLAIN'				 => 'Modifier les mots de faible pertinence',
	'TC_WORDS_EXPLAIN_TEXT' => 'Ces mots auront une pertinence inférieure dans l’algorithme de recherche par rapport aux mots normaux. Ils sont utiles pour filtrer les mots courants. Sans ces mots, les résultats de la recherche peuvent être moins précis.',
	'LANGUAGE_CHOOSE' => 'Choisissez votre langue',
	'LANGUAGE_CHOOSE_EXPLAIN' => 'Sélectionnez la langue pour laquelle vous souhaitez ajouter des mots de faible pertinence.',
	'TC_LANG_CREATE_EXPLAIN' => 'Ajoutez la langue de votre forum pour créer une nouvelle liste de mots peu pertinents.',
	'TC_LANG_CREATE' => 'Ajouter une nouvelle langue',
	'WHAT_IS_TC_FOR' => 'À quoi sert Topic Checker ?',
	'WHAT_IS_TC_FOR_EXPLAIN' => '<strong>Topic Checker</strong> aide les utilisateurs à éviter de créer des sujets en double.<br />Quand un utilisateur crée un nouveau sujet et rédige un titre, le vérificateur de sujets recherche automatiquement les sujets existants ayant des titres similaires et affiche les résultats en temps réel.<br />De cette façon, l’utilisateur peut voir si le sujet qu’il est sur le point de créer a déjà été traité dans le forum, réduisant ainsi la création de sujets en double.<br />Les mots de faible pertinence définis pour la langue sélectionnée seront utilisés par chaque utilisateur dans son propre panneau de contrôle.',
	'TC_STEP_1_ADD_LANG' => 'Étape 1 : Ajoutez la langue de votre forum',
	'TC_STEP_2_CHOOSE_WORDS' => 'Étape 2 : Ajouter des mots courants, avec une faible pertinence dans la recherche de sujets (facultatif)',
	'TC_STEP_3_CHOOSE_FORUMS' => 'Étape 3 : Choisir les forums où le vérificateur de sujets sera actif',
	'LANGUAGE_ALREADY_EXISTS' => 'La langue sélectionnée existe déjà dans la base de données.',
	'LANGUAGE_ADDED_SUCCESS' => 'Une nouvelle langue a été ajoutée avec succès.',
	'NO_LANGUAGE_SELECTED' => 'Aucune langue sélectionnée.',

]);
