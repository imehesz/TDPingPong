<?php 
	$games = $dataProvider->getData();
?>

<?php if( $games ) : ?>
    <?php foreach ($games as $game) : ?>
        <div style="height:225px;float:left;overflow:hidden;">
        <table id="hor-minimalist-b" style="float:left;">
            <thead>
                <tr>
                    <th style="text-align:center;" colspan="4">
                        Game: #<?php echo $game->id; ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">Name</td>
                    <td colspan="2"><?php echo $game->name; ?></td>
                </tr>
                <tr>
                    <td colspan="2">Played</td>
                    <td colspan="2"><?php echo date( 'm/d/Y', $game->created ); ?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="2" style="text-align:center;">Home</th>
                    <th colspan="2" style="text-align:center;">Visitor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color:#ffc;">
                        <ul style="padding:5px;margin:5px;">
                        <?php 
                            $players_home = Player::model()->findPlayersFromArray( explode( ',', $game->players_home ) );
                            if( $players_home )
                            {
                                foreach( $players_home as $player)
                                {
                                    echo '<li>' . $player->name . '</li>';
                                }
                            }
                        ?>
                        </ul>
                    </td>
                    <td style="background-color:#ffc;"><h3><?php echo $game->score_home; ?></h3></td>

                    <td style="background-color:#cfc;">
                        <ul style="padding:5px;margin:5px;">
                        <?php 
                            $players_visitor = Player::model()->findPlayersFromArray( explode( ',', $game->players_visitor ) );
                            if( $players_visitor )
                            {
                                foreach( $players_visitor as $player)
                                {
                                    echo '<li>' . $player->name . '</li>';
                                }
                            }
                        ?>
                        </ul>
                    </td>
                    <td style="background-color:#cfc;"><h3><?php echo $game->score_visitor; ?></h3></td>
                </tr>
            </tbody>
        </table>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<div style="clear:both;"></div>

<?php $this->widget('CLinkPager',array('pages'=>$dataProvider->pagination) ); ?>
