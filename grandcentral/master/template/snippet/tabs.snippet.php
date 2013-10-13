<ul class="tabs" data-target="content" <? if (isset($defaultSection)): ?>data-default="<?=$defaultSection?>"<? endif ?>>
	<? foreach($sections as $section) : ?>
	<? $app = $section['app']; ?>
	<?
	//	Try to find the right title for the tab
		$const = strtoupper('TABS_'.$handled_item.'_'.$section['key']);
		$title = (defined($const.'_TITLE')) ? constant($const.'_TITLE') : $section['title'];
		$descr = (defined($const.'_DESCR')) ? constant($const.'_DESCR') : $section['descr'];
	?>
		<li title="<?=$section['descr']?>" data-status="<?=$section['key']?>">
			<a href="<?='#'.$section['key']?>" data-section="<?=$section['key']?>" data-app="<?=$app['key']?>" data-template="<?=$app['template']?>">
				<span class="title"><?=$title?></span>
				<span class="descr"><?=$descr?></span>
			</a>
			<? if (isset($section['count'])) : ?><span class="cc-bubble"><?=$section['count']?></span><? endif; ?>
			<div class="droppable"></div>
		</li>
	<? endforeach; ?>
</ul>