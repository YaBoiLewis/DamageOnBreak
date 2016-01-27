<?php

namespace DOB;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->registerEvents($this,$this);
		$this->getLogger()->info(TF::YELLOW."Loaded!");
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML, array("Damage" => 1.5));
	}
	
	public function onBreak(BlockBreakEvent $ev){
		$player = $ev->getPlayer();
		$cfg = $this->config->getAll();
		if($ev->isCancelled()){
			$player->setHeatlh($player->getHealth() - $cfg["Damage"]);
			return;
		}
	}
	
	public function onDisable(){
		$this->getLogger()->info(TF::RED."Disabling.....");
	}
}
