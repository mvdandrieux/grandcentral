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
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Vars
/********************************************************************************************/
	$_FORM = $_PARAM['form'];

/********************************************************************************************/
//	Debug
/********************************************************************************************/
	// print'<pre>';print_r($_POST);print'</pre>';
	// print'<pre>';print_r($_FORM);print'</pre>';
	
/********************************************************************************************/
//	Insertion
/********************************************************************************************/
	list($site, $table) = explode('_', $_FORM['key']);
	$env = 'admin' == $site ? 'admin' : 'site';
	
	$id = (isset($_POST['id'])) ? $_POST['id'] : null;
	$i = cc($table, $id, $env);
	
	foreach ($_POST as $key => $value)
	{
		$i[$key] = $value;
		if ('id' == $key)
		{
			$i[$key]->database_set($value);
		}
	}
	// print'<pre>';print_r($i);print'</pre>';
	$i->save();
//	Send back the id as a confirmation
	echo $i['id'];
?>