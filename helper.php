<?php
/**
 * Helper class for Userlist module
 * 
 * @package    Userlist
 * @subpackage com_userlist
 * @version    1.1.0
 *
 * @author     Manuel Haeusler <tech.spuur@quickline.com>
 * @copyright  2018 Manuel Haeusler
 * @license    GNU/GPL, see LICENSE.php
 *
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModUserlistHelper
{
    /**
     * Retrieves all users from the database
     *
     * @param   string  $param_order_which      The order_which parameter of the module configuration
     * @param   string  $param_ordering         The ordering parameter of the module configuration
     *
     * @return  associative Array               Array with a list of all specified entries for every user
     * @since   1.0.0
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
            case 3:
                $order_which = 'block';
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