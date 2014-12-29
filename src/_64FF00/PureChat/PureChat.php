<?php

namespace _64FF00\PureChat;

use pocketmine\Player;

use pocketmine\plugin\PluginBase;

/*
      # #    #####  #       ####### #######   ###     ###   
      # #   #     # #    #  #       #        #   #   #   #  
    ####### #       #    #  #       #       #     # #     # 
      # #   ######  #    #  #####   #####   #     # #     # 
    ####### #     # ####### #       #       #     # #     # 
      # #   #     #      #  #       #        #   #   #   #  
      # #    #####       #  #       #         ###     ###                                        
                                                                                   
*/

class PureChat extends PluginBase
{
	private $config, $plugin, $factionspro;
	
	public function onLoad()
	{
		$this->saveDefaultConfig();
	}
	
	public function onEnable()
	{
		$this->plugin = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		$this->factionspro = $this->getServer()->getPluginManager()->getPlugin("FactionsPro");
		
		$this->getServer()->getPluginManager()->registerEvents(new ChatListener($this), $this);
	}
	
	public function formatMessage(Player $player, $message, $levelName = null)
	{
		$groupName = $this->plugin->getUser($player)->getGroup($levelName)->getName();
		
		if($levelName == null)
		{
			$chatFormat = $this->getConfig()->getNested("groups.$groupName.default");
		}
		else
		{
			$chatFormat = $this->getConfig()->getNested("groups.$groupName.worlds.$levelName");
		}
		
		$chatFormat = str_replace("%world_name%", $levelName, $chatFormat);
		$chatFormat = str_replace("%user_name%", $player->getName(), $chatFormat);
		$chatFormat = str_replace("%message%", $message, $chatFormat);
		if(!$this->factionspro == false) {
			if($this->factionspro->isInFaction($player->getName())) {
				$chatformat = str_replace("%faction%", $this->factionspro->getPlayerFaction($player->getName()), $chatFormat);
			}
		}
		
		
		return $chatFormat;
	}
	
	public function onDisable()
	{
	}
}