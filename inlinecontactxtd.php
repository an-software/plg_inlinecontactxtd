<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.inlinecontactxtd
 *
 * @copyright   (C) Alexander Niklaus. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @link        https://an-software.net
 */

defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Session\Session;

/**
 * Editor InlineContact button
 *
 * @since  1.0.0
 */
class PlgButtonInlinecontactxtd extends CMSPlugin
{

	/**
	 * @var CMSApplicationInterface|null
	 *
	 * @since 3.0.0
	 */
	protected $app = null; //?CMSApplicationInterface


	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display the button
	 *
	 * @param   string  $name  The name of the button to add
	 *
	 * @return  CMSObject|void  The button options as CMSObject
	 *
	 * @since   3.7.0
	 */
	public function onDisplay($name)
	{
		$user = $this->app->getIdentity();

		if ($user->authorise('core.create', 'com_contact')
			|| $user->authorise('core.edit', 'com_contact')
			|| $user->authorise('core.edit.own', 'com_contact'))
		{
			// The URL for the contacts list
			$link = 'index.php?option=com_inlinecontact&amp;view=select&amp;layout=modal&amp;tmpl=component&amp;'
				. Session::getFormToken() . '=1&amp;editor=' . $name;

			$button          = new CMSObject;
			$button->modal   = true;
			$button->link    = $link;
			$button->text    = Text::_('PLG_INLINECONTACTXTD_BUTTON');
			$button->name    = $this->_type . '_' . $this->_name;
			$button->icon    = 'address';
			$button->iconSVG = '<svg viewBox="0 0 448 512" width="24" height="24"><path d="M436 160c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20V48c'
				. '0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48v-48h20c6.6 0 12-5.4 1'
				. '2-12v-40c0-6.6-5.4-12-12-12h-20v-64h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20zm-228-32c35.3 0 64 28.7'
				. ' 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H118.4C106 384 96 375.4 96 364.'
				. '8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z">'
				. '</path></svg>';

			$button->options = [
				'height'     => '300px',
				'width'      => '800px',
				'bodyHeight' => '70',
				'modalWidth' => '80',
			];

			return $button;
		}
	}
}
