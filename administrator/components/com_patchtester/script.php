<?php
/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

use Joomla\CMS\Installer\Adapter\ComponentAdapter;
use Joomla\CMS\Installer\InstallerScript;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @since  2.0
 */
class Com_PatchtesterInstallerScript extends InstallerScript
{

	/**
	 * Extension script constructor.
	 *
	 * @since   3.0.0
	 */
	public function __construct()
	{
		$this->minimumJoomla = '4.0';
		$this->minimumPhp    = JOOMLA_MINIMUM_PHP;

		$this->deleteFiles = array(
			'/administrator/components/com_patchtester/PatchTester/View/Pulls/tmpl/default_errors.php',
		);

		$this->deleteFolders = array(
			'/administrator/components/com_patchtester/PatchTester/Table',
			'/components/com_patchtester',
		);
	}

	/**
	 * Function to perform changes during postflight
	 *
	 * @param   string            $type    The action being performed
	 * @param   ComponentAdapter  $parent  The class calling this method
	 *
	 * @return  void
	 *
	 * @since   3.0.0
	 */
	public function postflight($type, $parent)
	{
		$this->removeFiles();
		if ($type == 'install')
		{
			$language = JFactory::getLanguage();
			$language->load('com_patchtester', JPATH_ADMINISTRATOR, null, true);
			$language->load('com_patchtester', JPATH_SITE, null, true);
			?>
			<h1><img src="../media/com_patchtester/images/icon-48-patchtester.png"><?php echo Text::_('COM_PATCHTESTER'); ?></h1>
			<p><?php echo Text::_('COM_PATCHTESTER_XML_DESCRIPTION'); ?></p>
			<p><?php echo Text::_('COM_PATCHTESTER_GOTO_PATCHTESTER'); ?></a></p>
			<p><?php echo Text::_('COM_PATCHTESTER_GOTO_PATCHTESTER_OPTIONS'); ?></a></p>
            <?php
		}

		if ($type == 'uninstall')
		{
			$language = JFactory::getLanguage();
			$language->load('com_patchtester', JPATH_ADMINISTRATOR, null, true);
			$language->load('com_patchtester', JPATH_SITE, null, true);
			?>
			<h1><?php echo Text::_('COM_PATCHTESTER'); ?></h1>
			<p><?php echo Text::_('COM_PATCHTESTER_UNINSTALL_THANK_YOU'); ?></p>
            <?php
		}
	}
}
