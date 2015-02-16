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
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('master/css/googlepreview.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Our item
	if (isset($_GET['item']) && isset($_GET['id'])) $item = i($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
	
//	Popularity image Google
	$m='data:image/png,%89PNG%0D%0A%1A%0A%00%00%00%0DIHDR%00%00%002%00%00%00%07%02%03%00%00%007%E6%F6%3C%00%00%00%03sBIT%08%08%08%DB%E1O%E0%00%00%00%0CPLTE%FF%FF%FF%FF%FF%FF%CC%CC%CC%A7%D3%A7Mz%23%09%00%00%00%04tRNS%00%FF%FF%FF%B3-%40%88%00%00%00%09pHYs%00%00%0B%12%00%00%0B%12%01%D2%DD~%FC%00%00%00%16tEXtCreation%20Time%0005%2F01%2F08%FA%82\'%90%00%00%00%18tEXtSoftware%00Adobe%20FireworksO%B3%1FN%00%00%00%22IDAT%08%99ch%60%60%00%22%05(Z%85%04%160%EC%FF%0F%03%A1%A1%09xy%A8%FAP%CC%04%00%1D%FC41%87%D3%A9k%00%00%00%00IEND%AEB%60%82';
	
	$lorem = new attrString('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	
	$title = null;
	$descr = null;
?>