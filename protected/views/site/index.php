<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to the <i><?php echo CHtml::encode(Yii::app()->name); ?></i> site.</h1>

<div class="front-top-block">
	<h3 class="text-center">Hello</h3>
	<p>This site was developed to track the never ending <strong>ping-pong</strong> war between <a href="http://tampadigital.com" target="_blank" title="Tampa Digiatal - Let's Think Together">Tampa Digiatal</a> employees. Everything else is pretty self explanitaritory :)</p>
	<p>
		If you are en employee, just get a <a href="http://en.wikipedia.org/wiki/Table_tennis_racket" target="_blank">paddle</a> and <strong>join the fun</strong>!
	</p>
	<p>Thanks for checking us out!</p>
</div>

<div class="front-top-block">
	<h3 class="text-center">Photos</h3>
	<?php echo CHtml::link( CHtml::image( 'http://www.goldbamboo.com/images/content/9488-400px-tt-table-table-tennis.gif' ), 'http://en.wikipedia.org/wiki/Table_tennis', array( 'title' => 'Daddy, what is Table Tennis?', 'target' => '_blank' ) ); ?>
</div>

<div style="clear:both;"></div>

<div class="front-block">
	<h3 class="text-center">Stats</h3>
	<div>
		<div style="width:150px;">
			<table>
				<thead>
					<tr>
						<th colspan="3" align="right">Top 10</th>
					</tr>
					<tr>
						<th>Pos.</th>
						<th>Name</th>
						<th>Win</th>
					</tr>
				</thead>
				<tbody>
					<?php $top10 = Player::model()->findAll( 'created <> 0 ORDER BY won DESC LIMIT 10' ); ?>
					<?php $pos=1; foreach( $top10 as $player ) : ?>
						<tr>
							<td><?php echo $pos > 3 ? $pos : '<span style="font-weight:bolder;">' . $pos  . '</span>'; ?>. </td>
							<td><?php echo $pos > 3 ? $player->name : "<span style='font-weight:bolder;'>{$player->name}</span>"; ?></td>
							<td><?php echo $player->won > 0 ? $player->won . ' (' . round(($player->won / ($player->won+$player->lost))*100 ) . '%)' : $player->won; ?></td>
						</tr>
					<?php $pos++; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="front-block">
	<h3 class="text-center">Coming Soon</h3>
	<img src="http://www.djelectricnoiz.net/images/under_construction.png" />
</div>

