<?PHP

	// Reject any unwanted access.
	if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
	
	$player = $GLOBALS['player'];
	$config = $GLOBALS['config'];
	$SQL = POT::getInstance()->getDBHandle();
	
	$characters = $SQL->query( 'SELECT `c`.`name`, `c`.`vocation`, `c`.`world_id` FROM `players` AS `c` LEFT JOIN `players` AS `p` ON `p`.`account_id` = `c`.`account_id` WHERE `p`.`id` = '.$player->getId( ).' AND `c`.`id` != '.$player->getId( ).';' )->fetchAll( );
	
	echo '<div class="bar">Characters</div>';
	foreach( $characters as $character )
	{
		?>
		<table style="width: 100%;">
			<tr>
				<td style="width: 40%;"><?PHP echo $character['name']; ?></td>
				<td style="width: 25%;"><?PHP echo $config['vocations'][$character['vocation']]; ?></td>
				<td style="width: 25%;"><?PHP echo $config['worlds'][$character['world_id']]; ?></td>
				<td style="width: 10%;"><a href="<?PHP echo WEBSITE; ?>/index.php/character/view/<?PHP echo strtolower( urlencode( $character['name'] ) ); ?>"><strong>View</strong></a></td>
			</tr>
		</table>
		<?PHP
	}
?>