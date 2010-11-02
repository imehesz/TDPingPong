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
		<div style="width:150px;float:left;">
			<table id="hor-minimalist-b">
				<thead>
					<tr>
						<th colspan="4" align="center" style="text-align:center;">Top 10</th>
					</tr>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th colspan="2">Wins</th>
					</tr>
				</thead>
				<tbody>
					<?php $top10 = Player::model()->findAll( 'created <> 0 ORDER BY won DESC LIMIT 10' ); ?>
					<?php $pos=1; foreach( $top10 as $player ) : ?>
						<tr>
							<td><?php echo $pos > 3 ? $pos : '<span style="font-weight:bolder;">' . $pos  . '</span>'; ?>. </td>
							<td><?php echo $pos > 3 ? $player->name : "<span style='font-weight:bolder;'>{$player->name}</span>"; ?></td>
							<td align="right" style="text-align:right;">
                                <?php 
                                    if( $pos > 3 )
                                    {
                                        echo $player->won > 0 ? $player->won : 0; 
                                    }
                                    else
                                    {
                                        echo $player->won > 0 ? '<span style="font-weight:bolder;">' . $player->won . '</span>' : 0; 
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo $player->won > 0 ? round(($player->won / ($player->won+$player->lost))*100 ) . '%' : ''; ?>
                            </td>
						</tr>
					<?php $pos++; endforeach; ?>
				</tbody>
			</table>
		</div>
 		<div style="width:145px;float:left;margin-left:50px;">
			<table id="hor-minimalist-b">
				<thead>
					<tr>
						<th colspan="4" align="right" style="text-align:center;">Last Game</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="background-color:#ffc;">
							<?php foreach( $home_team as $key => $player_name ) : ?>
								<div><?php echo $player_name; ?></div>
							<?php endforeach; ?>
						</td> 
						<td style="background-color:#ffc;"><h3><?php echo $lastgame_played->score_home; ?></h3></td>
						<td style="background-color:#cfc;">
							<?php foreach( $visitor_team as $key => $player_name ) : ?>
								<div><?php echo $player_name; ?></div>
							<?php endforeach; ?>
						</td>
						<td style="background-color:#cfc;"><h3><?php echo $lastgame_played->score_visitor; ?></h3></td>
					</tr>
                    <tr><td></td></tr>
				</tbody>

				<thead>
					<tr>
						<th colspan="4" align="right" style="text-align:center;">All Games</th>
					</tr>
				</thead>
				<tbody>
						<tr>
                            <td colspan="2">Games played</td>
                            <td colspan="2" style="text-align:right;"><?php echo sizeof( Game::model()->findAll() ); ?></td>
						</tr>
                        <tr>
                            <td colspan="2">Last game on</td>
                            <td colspan="2" style="text-align:right;">
                                <?php 
                                    echo $lastgame_played ? str_replace( '_', '&nbsp;',date( 'F,_d', $lastgame_played->created ) ) : 'n/a';
                                ?>
                            </td>
                        </tr>
                        <tr><td></td></tr>
				</tbody>
				<thead>
					<tr>
						<th colspan="4" align="right" style="text-align:center;">Players</th>
					</tr>
				</thead>
                <tbody>
                        <tr>
                            <td colspan="2">Numbe of Players</td>
                            <td colspan="2" style="text-align:right;"><?php echo sizeof( Player::model()->findAll( 'created<>0' ) ); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Home Score (Sum)</td>
                            <td colspan="2" style="text-align:right;">
                                <?php // echo (int)Game::model()->with('homeScore')->findAll()->homeScore; 
                                    // TODO make this better, Yii like :/
                                    $score = 0;
                                    foreach( Game::model()->findAll('created<>0') as $game )
                                    {
                                        $score += $game->score_home;
                                    }
                                    echo $score;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Visitor Score (Sum)</td>
                            <td colspan="2" style="text-align:right;">
                                <?php
                                    //echo Game::model()->with('visitorScore')->findAll()->visitorScore;
                                    $score = 0;
                                    // TODO bad code, FIX it
                                    foreach( Game::model()->findAll('created<>0') as $game )
                                    {
                                        $score += $game->score_visitor;
                                    }
                                    echo $score;
                                ?>
                            </td>
                        </tr>
                </tbody>
			</table>
		</div>
       
	</div>
</div>

<div class="front-block">
	<h3 class="text-center">Ads (for now)</h3>
    <div class="text-center">
        <script type="text/javascript"><!--
        google_ad_client = "pub-1319358860215477";
        /* ad on TD Ping Pong */
        google_ad_slot = "5091684225";
        google_ad_width = 336;
        google_ad_height = 280;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
    </div>
</div>

