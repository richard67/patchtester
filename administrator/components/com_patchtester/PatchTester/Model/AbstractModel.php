<?php
/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

namespace PatchTester\Model;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

/**
 * Base model for the patch testing component
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class AbstractModel
{
	/**
	 * The database driver.
	 *
	 * @var    \JDatabaseDriver
	 * @since  __DEPLOY_VERSION__
	 */
	protected $db;

	/**
	 * The model state.
	 *
	 * @var    Registry
	 * @since  __DEPLOY_VERSION__
	 */
	protected $state;

	/**
	 * Instantiate the model.
	 *
	 * @param   Registry          $state  The model state.
	 * @param   \JDatabaseDriver  $db     The database adpater.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct(Registry $state = null, \JDatabaseDriver $db = null)
	{
		$this->state = $state ?: new Registry;
		$this->db    = $db ?: Factory::getDbo();
	}

	/**
	 * Get the database driver.
	 *
	 * @return  \JDatabaseDriver
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getDb()
	{
		return $this->db;
	}

	/**
	 * Get the model state.
	 *
	 * @return  Registry
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Set the database driver.
	 *
	 * @param   \JDatabaseDriver  $db  The database driver.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function setDb(\JDatabaseDriver $db)
	{
		$this->db = $db;
	}

	/**
	 * Set the model state.
	 *
	 * @param   Registry  $state  The state object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function setState(Registry $state)
	{
		$this->state = $state;
	}
}
