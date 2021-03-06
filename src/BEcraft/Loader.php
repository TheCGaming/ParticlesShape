<?php

namespace BEcraft;

use pocketmine\{Server, Player};
use pocketmine\plugin\PluginBase;
use pocketmine\level\{Level, Position, Location};
use BEcraft\Tasks\{DoubleHelix, Crown, CloudRain, Laser, Helix, Dring, Tornado, Party, Edita};
use BEcraft\ParticleCommand;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase{
	
	const PREFIX = TextFormat::GRAY."[".TextFormat::WHITE."P".TextFormat::GREEN."S".TextFormat::GRAY."]".TextFormat::RESET;
	
	public $tasks;
	
	public function onEnable(){
	$this->getLogger()->info(TextFormat::GREEN."Plugin has been enabled!".PHP_EOL.TextFormat::GOLD."Author: ".TextFormat::AQUA."@BEcraft_MCPE");
	$this->getServer()->getCommandMap()->register("particles", new ParticleCommand("particles", $this));
	$this->tasks = [];
	}
	
	public function onDisable(){
	$this->getLogger()->info(TextFormat::RED."Plugin has been disabled!");
	}
	
	public function onLoad(){
	$this->getLogger()->info(TextFormat::YELLOW."Loading plugin...");
	}
	
	public function removeTask($id){
	$this->getServer()->getScheduler()->cancelTask($id);
	}
	
	public function existsTask($name){
	return array_key_exists($name, $this->tasks);
	}
	
	public function getTasks(){
	if(empty($this->tasks)){
	return TextFormat::RED."There are not tasks";
	}
	$keys = implode(", ", array_keys($this->tasks));
	return TextFormat::GREEN.$keys;
	}
	
	public function newCrown(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Crown($this, $location, $level), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newEdita(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Edita($this, $location, $level), 10);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newParty(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Party($this, $location, $level), 65);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newTornado(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Tornado($this, $location, $level), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newDring(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Dring($this, $location, $level), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newCloud(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new CloudRain($this, $location, $level), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newLaser(Player $player, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Laser($this, $player), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newHelix(Location $location, Level $level, $name){
	$this->getServer()->getScheduler()->scheduleRepeatingTask($task = new Helix($this, $location, $level), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
	public function newDoubleHelix(Location $location, Level $level, $name){
    $this->getServer()->getScheduler()->scheduleRepeatingTask($task = new DoubleHelix($this, $location, $level), 5);
	$this->tasks[$name] = $task->getTaskId();
	}
	
    }