<?php
namespace _64FF00\PureChat;

use pocketmine\utils\Config;

class Configuration
{
	private $config;
	
	public function __construct(PureChat $plugin)
	{
		$this->plugin = $plugin;
		
		$this->loadConfig();
	}
	
	public function getValue($key)
	{
		$value = $this->config->get($key);
		
		if($value === null)
		{
			$this->plugin->getLogger()->warning("Key $key not found in config.yml.");
			
			return null;
		}
		
		return $value;
	}
	
	public function loadConfig()
	{
		$this->plugin->saveDefaultConfig();
		
		$this->config = $this->plugin->getConfig();
	}
	
	public function reloadConfig()
	{	
		$this->plugin->reloadConfig();
		
		$this->loadConfig();
	}
}