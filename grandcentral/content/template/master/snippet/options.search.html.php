<ul class="searchList" data-nodata="<?=$nodata?>"><?php if (isset($results)) : ?>
<?php foreach ($results as $result): ?><li><a href="<?=$result->edit()?>" title=""><?=$result['title']?></a></li><?phpendforeach?>
<?php endif ?></ul>