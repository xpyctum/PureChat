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
	private $config, $plugin;
	
	public function onLoad()
	{
		$this->config = new Configuration($this);
	}
	
	public function onEnable()
	{
		$this->plugin = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		
		$this->getServer()->getPluginManager()->registerEvents(new ChatListener($this), $this);
	}
	
	public function formatMessage(Player $player, $message)
	{
		$chatFormat = $this->config->getValue("chat-format");
		
		$isMultiWorldPermsEnabled = $this->plugin->getPPConfig()->getValue("enable-multiworld-perms");
		
		$levelName = $isMultiWorldPermsEnabled ? $player->getLevel()->getName() : null;
		
		$chatFormat = str_replace("%world_name%", $levelName, $chatFormat);
		$chatFormat = str_replace("%user_name%", $player->getName(), $chatFormat);		
		$chatFormat = str_replace("%message%", $message, $chatFormat);
		
		$group = $this->plugin->getUser($player)->getGroup($levelName);
		
		$chatFormat = str_replace("%group%", $group->getName(), $chatFormat);
		
		return $chatFormat;
	}
	
	public function onDisable()
	{
	}
}