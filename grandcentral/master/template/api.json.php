<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 * 
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
//	So, GET or POST ?
//	if (isset($_GET)) $_POST = $_GET;

/********************************************************************************************/
//	DEBUG
/********************************************************************************************/
	if (isset($_POST['DEBUG']))
	{
		unset($_POST['DEBUG']);
		sentinel::debug('AJAX debug ('.__FILE__.' line '.__LINE__.')', $_POST);
	}

/********************************************************************************************/
//	This API has the right content-type. Now Lets find the content
/********************************************************************************************/
//	Some vars
	$app = $_POST['app'];
	$key = $_POST['template'];
		
//	Call the right app
	echo new app($app, $key);
?>