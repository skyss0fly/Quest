<?php

namespace NhanOfficial\nhiemvu;

use pocketmine\scheduler\Task;
use NhanOfficial\nhiemvu\Main;

class TickTask extends Task{
  
  /** @var Main $main */
  private $main;
  
  public function __construct(Main $main){
  $this->main = $main;
  }
  
  public function onRun() : void{
  $this->main->tick();
  }
}