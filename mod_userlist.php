<?php
/**
 * Hello World! Module Entry Point
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;

// Pick out the iput-fields of the backend
$order_which = $params->get('order_which');
$ordering = $params->get('ordering');

$basePath = dirname(__FILE__);


// if (!JFactory::getUser()->authorise('core.edit', 'com_content'))
// {
// 	throw new JAccessExceptionNotallowed(JText::_('JERROR_ALERTNOAUTHOR'), 403);
// }

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$items = modUserlistHelper::getItems($order_which, $ordering);
require JModuleHelper::getLayoutPath('mod_userlist');
