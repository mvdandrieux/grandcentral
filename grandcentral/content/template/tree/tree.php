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
//	Bind
/********************************************************************************************/	
	$_APP->bind_file('css', 'tree/css/tree.css');
//	$_APP->bind_file('script', 'tree/js/nestedSortable/jquery.mjs.nestedSortable.js');
//	$_APP->bind_file('script', 'js/nestedSortable/jquery.ui.touch-punch.js');
//	$_APP->bind_file('script', 'tree/js/nestedSortable/tree.js');
	
	$_APP->bind_file('script', 'tree/js/jsplumb/jquery.jsPlumb-1.4.1-all-min.js');
	$_APP->bind_code('script', '
	initPlumb = function()
	{
		jsPlumb.ready(function()
		{
		//	Some vars
			var connectorLineWidth = 1;
			var connectorColor = "#666";
		
			jsPlumb.importDefaults(
			{			
				Connector : [ "Flowchart", { stub:[40, 40]} ],
				PaintStyle : { strokeStyle:connectorColor, lineWidth:connectorLineWidth },
				EndpointStyle : { radius:2, fillStyle:connectorColor },
				HoverPaintStyle : {strokeStyle:"#ec9f2e" },
				EndpointHoverStyle : {fillStyle:"#ec9f2e" },			
				Anchors :  [ "BottomCenter", "TopCenter" ]
			});
		
		//	Connect
			jsPlumb.connect({source:"page_1", target:"page_12"});
			jsPlumb.connect({source:"page_1", target:"page_14"});
			jsPlumb.connect({source:"page_1", target:"page_19"});
			jsPlumb.connect({source:"page_1", target:"page_16"});
			jsPlumb.connect({source:"page_1", target:"page_17"});
		
			jsPlumb.connect({source:"page_14", target:"page_20"});
			jsPlumb.connect({source:"page_14", target:"page_21"});
		});
	};
	');

/********************************************************************************************/
//	Make the tree
/********************************************************************************************/
	class tree
	{
		private $start = 'page_home';
		private $class = 'tree';
		private $tree;
		private $pages;
		private $ref;
		
		public function __construct()
		{
		//	query the pages
			$this->get_pages();
		//	build the tree
			$this->tree[0] = $this->prepare_tree($this->start, 0);
		}
		
		private function get_pages()
		{
			$q = 'SELECT id FROM `page` WHERE `key` = "home" OR `system` = false';
			$db = database::connect($_SESSION['pref']['handled_env']);
			$r = $db->query($q);
			foreach ($r['data'] as $data)
			{
				$ids[] = $data['id'];
			}
		//	This will be the bunch of items that fit in the site tree
			$this->pages = cc('page', array
			(
				'id' => $ids,
			), $_SESSION['pref']['handled_env']);
		//	DEBUG: our pages
			// sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $this->pages);
			
			if ($this->pages->count > 0)
			{
			//	Find the home page
				$this->pages->set_index('key');
				$this->start = $this->pages[$this->start]->get_nickname();
			//	set_index
				$this->pages->set_index('id');
			//	create the reference bunch
				$this->ref = clone $this->pages;
			}
			else
			{
				trigger_error('No page. No tree. What else ?', E_USER_NOTICE);
			}
		}
		
		private function prepare_tree($start, $key)
		{
			if (isset($this->pages[$start]))
			{
				$tmp = array(
					'id' => $start,
					'key' => $key
				);
				if (!$this->pages[$start]['child']->is_empty())
				{
					$base = ($key != 0) ? $key.'.' : null;
					$position = 1;
					foreach ($this->pages[$start]['child'] as $ref)
					{
						if (isset($this->pages[$ref]))
						{
							$tmp['children'][] = $this->prepare_tree($ref, $base.$position);
						}
						$position++;
					}
				}
				$tree = $tmp;
				unset($this->pages[$start]);
				return $tree;
			}
		}
		
		private function add_norel()
		{
			foreach ($this->pages as $page)
			{
				$key = (isset($this->tree[0]['children'])) ? count($this->tree[0]['children']) + 1 : 1;
				$this->tree[0]['children'][] = array(
					'id' => $page->get_nickname(),
					'key' => $key
				);
			}
		}
		
		private function make_tree($tree, $class = null)
		{
			$li = null;
			foreach ($tree as $node)
			{
				$page = $this->ref[$node['id']];
				$node['id'] = ($page['key'] == 'home') ? 'home' : $node['id'];
				
			//	Do you have zones ?
				/* TODO */
	
			//	Is this a feed ?
				if ($page['type']['key'] == 'feed')
				{
					$feed = '<div class="detail">'.$page['type']['item'].'</div>';
				}
				else $feed = null;
			//	Do you want a badge ?
				$badge = '<a href="" class="cc-badge">12</a>';
				
			//	Content
				$content = '
				<div class="page" data-status="'.$page['status'].'">
					<div class="icon" id="'.$page->get_nickname().'">
						<div class="title"><a href="'.$page->edit().'">'.$page['title'].'</a></div>
						'.$badge.'
					</div>
					'.$feed.'
				</div>';
			//	Build the <li>
				if (isset($node['children'])) $content .= $this->make_tree($node['children']);
				$li .= '<li data-item="'.$page->get_nickname().'">'.$content.'</li>';
			}
			if (!is_null($class)) $class = ' class="'.$class.'"';
		//	Return
			return '<ol'.$class.'>'.$li.'</ol>';
		}
		
		public function __tostring()
		{
			return $this->make_tree($this->tree, $this->class);
		}
	}
//	Build the tree
	$tree = new tree();	
?>