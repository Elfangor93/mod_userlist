<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModUserlistHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getItems($param_order_which, $param_ordering)
    {
        switch ($param_ordering) {
            case 0:
                $ordering = 'ASC';
                break;
            case 1:
                $ordering = 'DESC';
                break;
            default:
                $ordering = 'ASC';
                break;
        }

        switch ($param_order_which) {
            case 0:
                $order_which = 'name';
                break;
            case 1:
                $order_which = 'username';
                break;
            case 2:
                $order_which = 'email';
                break;            
            default:
                $order_which = 'name';
                break;
        }

        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                    ->select(array('name', 'username', 'email', 'block', 'activation', 'registerDate', 'lastvisitDate'))
                    ->from($db->quoteName('#__users'))
                    ->order($order_which . ' ' . $ordering);
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadAssocList();
        // Return the Hello
        return $result;
    }
}