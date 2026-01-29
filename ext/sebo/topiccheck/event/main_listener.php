<?php

/**
 *
 * sebo-topiccheck. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026, sebo, https://www.fiatpandaclub.org
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace sebo\topiccheck\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Main listener class
 */
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template	$template
	 * @param \phpbb\controller\helper	$helper
	 * @param \phpbb\user				$user
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\controller\helper $helper, \phpbb\user $user)
	{
		$this->template = $template;
		$this->helper = $helper;
		$this->user = $user;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.page_header' => 'add_search_url_variable',
		];
	}

	/**
	 * Add the search route URL to the template variables
	 *
	 * @param \phpbb\event\data $event The event object
	 * @return void
	 */
	public function add_search_url_variable($event)
	{
		// Only load this variable if we are in posting mode
		if ($this->user->page['page_name'] == 'posting.php')
		{
			$this->template->assign_vars([
				'U_SEBO_TOPIC_SEARCH' => $this->helper->route('sebo_topiccheck_search'),
			]);
		}
	}
}
