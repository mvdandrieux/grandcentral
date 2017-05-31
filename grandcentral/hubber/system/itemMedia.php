<?php
/**
* TDC Media object
*
* @package  Core
* @author   Sylvain Frigui <sf@cafecentral.fr>
* @access   public
* @see      http://www.cafecentral.fr/fr/wiki
*/
class itemMedia extends _items
{
  public static function get_media($options = []) {
		$params['limit()'] = isset($options['limit']) ? $options['limit'] : 12;
		$params['order()'] = isset($options['order']) ? $options['order'] : 'created DESC';
		if (isset($options['type']) && !empty($options['type'])) $params['type'] = $options['type'];
		if (isset($options['category']) && !empty($options['category'])) $params['category'] = $options['category'];
    if (isset($options['tag']) && !empty($options['tag'])) $params['tag'] = $options['tag'];
		if (isset($options['search']) && !empty($options['search']))
    {
		    $db = database::connect('site');
        $q = 'SELECT id FROM media WHERE `title` LIKE "%'.$options['search'].'%" OR `descr` LIKE "%'.$options['search'].'%" OR `text` LIKE "%'.$options['search'].'%"';
        $r = $db->query($q);
        $ids = [];
        foreach ($r['data'] as $value)
        {
          $ids[] = $value['id'];
        }
        $params['id'] = $ids;
		}

    return i('media', $params);
	}
}
?>
