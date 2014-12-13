<?php

namespace _64FF00\PureChat;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;

/*
      # #    #####  #       ####### #######   ###     ###   
      # #   #     # #    #  #       #        #   #   #   #  
    ####### #       #    #  #       #       #     # #     # 
      # #   ######  #    #  #####   #####   #     # #     # 
    ####### #     # ####### #       #       #     # #     # 
      # #   #     #      #  #       #        #   #   #   #  
      # #    #####       #  #       #         ###     ###                                        
                                                                                   
*/

class ChatListener implements Listener
{
	public function __construct(PureChat $plugin)
	{
		$this->plugin = $plugin;
	}
	
	public function onPlayerChat(PlayerChatEvent $event)
	{
		$player = $event->getPlayer();
		
		$chatFormat = $this->plugin->formatMessage($player, $event->getMessage());
		
		$event->setFormat($chatFormat);
	}
}