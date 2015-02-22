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
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FORM = $_APP->param['form'];
	$asides = array();
	$asideFields = array('id', 'key',  'url', 'owner', 'created', 'updated', 'status', 'system', 'version');

/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/form.css');
	$_APP->bind_css('css/field.css');
	$_APP->bind_script('js/validate.plugin.js');
	$_APP->bind_script('js/form.js');
	$_APP->bind_script('js/item.js');
	$_APP->bind_code('script', '(function($) {$(\'section form\').validate();})(jQuery);');
?> 