<?php

namespace NhanOfficial\nhiemvu;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use NhanOfficial\nhiemvu\FormCommand;
use NhanOfficial\nhiemvu\TickTask; 
use NhanOfficial\nhiemvu\EventListener;

class Main extends PluginBase{
  
  /** @var Config $nv */
  public $nv;
  
  public function onEnable() : void{
  $this->saveDefaultConfig();
  $this->nv = new Config($this->getDataFolder() . "nhiemvu.yml", Config::YAML);
  $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
  $this->getServer()->getCommandMap()->register("Nhiemvu", new FormCommand($this));
  $this->getScheduler()->scheduleRepeatingTask(new TickTask($this), 20);
  }
  
  public function onDisable() : void{
  $this->nv->save();
  }
  
  public function tick() : void{
  foreach($this->nv->getAll() as $name => $data){
  if($data["timecheck"] === true){
  $this->nv->setNested($name . ".time", ($this->nv->getNested($name . ".time") - 1));
  $this->nv->save();
  if($data["time"] <= 0){
  $this->nv->setNested($name . ".timecheck", false);
  $this->nv->setNested($name . ".time", 0);
  $this->nv->save();
  }
  }
  }
  }
}
