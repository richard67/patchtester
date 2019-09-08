<?php
/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

namespace PatchTester;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;
use PatchTester\GitHub\GitHub;

/**
 * Helper class for the patch tester component
 *
 * @since  2.0
 */
abstract class Helper
{
	/**
	 * Initializes the GitHub object
	 *
	 * @return  GitHub
	 *
	 * @since   2.0
	 */
	public static function initializeGithub()
	{
		$params = ComponentHelper::getParams('com_patchtester');

		$options = new Registry;

		// Set a user agent for the request
		$options->set('userAgent', 'PatchTester/3.0');

		// Set the default timeout to 120 seconds
		$options->set('timeout', 120);

		// Set the API URL
		$options->set('api.url', 'https://api.github.com');

		// If an API token is set in the params, use it for authentication
		if ($params->get('gh_token', ''))
		{
			$options->set('gh.token', $params->get('gh_token', ''));
		}
		// Set the username and password if set in the params
		elseif ($params->get('gh_user', '') && $params->get('gh_password'))
		{
			$options->set('api.username', $params->get('gh_user', ''));
			$options->set('api.password', $params->get('gh_password', ''));
		}
		// Display a message about the lowered API limit without credentials
		else
		{
			Factory::getApplication()->enqueueMessage(Text::_('COM_PATCHTESTER_NO_CREDENTIALS'), 'notice');
		}

		return new GitHub($options);
	}

	/**
	 * Initializes the CI Settings
	 *
	 * @return  Registry
	 *
	 * @since   3.0
	 */
	public static function initializeCISettings()
	{
		$options = new Registry;

		// Set CI server address for the request
		$options->set('server.url', 'https://stuff.gramma.name');

		// Set name of the zip archive
		$options->set('zip.name', 'build.zip');

		// Set temp archive for extracting and downloading files
		$options->set('folder.temp', JPATH_COMPONENT . '/temp');
		$options->set('folder.backups', JPATH_COMPONENT . '/backups');

		// Set full url for addressing the file
		$options->set('zip.url', $options->get('server.url') . '/%s/' . $options->get('zip.name'));

		return $options;
	}
}
