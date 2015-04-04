<h1><?=$ini['about']['title']?></h1>
<?php foreach ($ini as $h2 => $h3) : ?>

	<?php
		$content = null;
		foreach ($h3 as $h3 => $line)
		{
			$td = null;
			if (is_array($line))
			{
				foreach ($line as $li) $td .= '<li>'.$li.'</li>';
				$td = '<ul>'.$td.'</ul>';
			}
			else $td = '<p>'.$line.'</p>';

			if ($td)
			{
				$content .= '
				<table>
					<tr>
						<th>'.$h3.'</th>
						<td>'.$td.'</td>
					</tr>
				</table>';
			}
		}
	?>
	
	<?php if ($content): ?>
		<h2><span class="rule"><?=cst('APPINI_H2_'.$h2, $h2)?></span></h2>
		<?=$content?>
	<?php endif ?>
	
<?php endforeach ?>