<?php
$ide = new IDE;
try { $ide->loadInjections('guild_view'); } catch(Exception $e) { error($e->getMessage()); }
$logo = (file_exists("public/guild_logos/".$guild->getId().".gif")) ? "<img src='".WEBSITE."/public/guild_logos/".$guild->getId().".gif' width='64' height='64'>" : "<img src='".WEBSITE."/public/guild_logos/default.gif'>";
	echo "<div style='float: left; padding-right: 10px;'>$logo</div>";
	echo "<h1>".$guild->getName()."</h1>";
	echo $guild->getCustomField("motd");
	echo "<br /><br />Guild owner: <b><a href='".WEBSITE."/index.php/character/view/".$guild->getOwner()."'>".$guild->getOwner()."</a></b><br /><br />";
	
	$rank_list = $guild->getGuildRanksList();
	$rank_list->orderBy('level', POT::ORDER_DESC);
	$showed_players = 1;
	echo "<table width='100%'>";
		foreach($rank_list as $rank)
		{
			$players_with_rank = $rank->getPlayersList();
			$players_with_rank->orderBy('name');
			$players_with_rank_number = count($players_with_rank);
			if($players_with_rank_number > 0)
			{
				echo "<tr class='rankBar'><td><b>".$rank->getName()."</b></td></tr>";
				foreach($players_with_rank as $player)
				{
					$guild_nick = $player->getGuildNick();
					if(!empty($guild_nick)) $guild_nick = "($guild_nick)"; else $guild_nick = "";
						
					echo "<tr class='playerGuildBar'><td><a href='".WEBSITE."/index.php/character/view/".$player->getName()."'>".$player->getName()."</a> $guild_nick</td></tr>";
				}
			}
		}
	echo "</table>";
		
		
?>