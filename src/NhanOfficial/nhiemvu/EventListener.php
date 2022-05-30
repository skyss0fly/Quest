<?php

namespace NhanOfficial\nhiemvu;

use pocketmine\player\Player;
use pocketmine\entity\Living;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use NhanOfficial\nhiemvu\Main;
use onebone\economyapi\EconomyAPI;

class EventListener implements Listener{
  
  /** @var Main $main */
  private $main;
  
  public function __construct(Main $main){
  $this->main = $main;
  }
  
  public function onJoin(PlayerJoinEvent $event){
  $player = $event->getPlayer();
  if(!$this->main->nv->exists($player->getName())){
  $this->main->nv->setNested($player->getName() . ".nv", false);
  $this->main->nv->setNested($player->getName() . ".time", 0);
  $this->main->nv->setNested($player->getName() . ".timecheck", false);
  $this->main->nv->setNested($player->getName() . ".nv1.check", false);
  $this->main->nv->setNested($player->getName() . ".nv1.count", 0);
  $this->main->nv->setNested($player->getName() . ".nv2.check", false);
  $this->main->nv->setNested($player->getName() . ".nv2.count", 0);$this->main->nv->setNested($player->getName() . ".nv3.check", false);
  $this->main->nv->setNested($player->getName() . ".nv3.count", 0); 
  $this->main->nv->setNested($player->getName() . ".nv4.check", false);
  $this->main->nv->setNested($player->getName() . ".nv4.count", 0);
  $this->main->nv->setNested($player->getName() . ".top", 0);
  $this->main->nv->save();
  }
  }
  
  public function onBreak(BlockBreakEvent $event){
  $player = $event->getPlayer();
  $block = $event->getBlock();
  if(!$event->isCancelled()){
  if($this->main->nv->getNested($player->getName() . ".nv1.check") === true){
  $this->main->nv->setNested($player->getName() . ".nv1.count", ($this->main->nv->getNested($player->getName() . ".nv1.count") + 1));
  $this->main->nv->save();
  $player->sendPopup("§aTiến trình nhiệm vụ: §7" . ($this->main->nv->getNested($player->getName() . ".nv1.count")) . "§e/§c100");
  if($this->main->nv->getNested($player->getName() . ".nv1.count") >= 100){
  $this->main->nv->setNested($player->getName() . ".nv", false);
  $this->main->nv->setNested($player->getName() . ".nv1.check", false);
  $this->main->nv->setNested($player->getName() . ".nv1.count", 0);
  $this->main->nv->setNested($player->getName() . ".time", $this->main->getConfig()->get("time"));
  $this->main->nv->setNested($player->getName() . ".timecheck", true);
  $this->main->nv->setNested($player->getName() . ".top", ($this->main->nv->getNested($player->getName() . ".top") + 1));
  $this->main->nv->save();
  EconomyAPI::getInstance()->addMoney($player, $this->main->getConfig()->getNested("money.nv1"));
  $player->sendTitle("§l§aĐÃ HOÀN THÀNH NHIỆM VỤ", "§l§eTHƯỞNG " . ($this->main->getConfig()->getNested("money.nv1")) . " Xu");
  }
  }
  if($block->getId() === 59 and $block->getMeta() === 7){
  if($this->main->nv->getNested($player->getName() . ".nv3.check") === true){
  $this->main->nv->setNested($player->getName() . ".nv3.count", ($this->main->nv->getNested($player->getName() . ".nv3.count") + 1));
  $this->main->nv->save();
  $player->sendPopup("§aTiến trình nhiệm vụ: §7" . ($this->main->nv->getNested($player->getName() . ".nv3.count")) . "§e/§c80");
  if($this->main->nv->getNested($player->getName() . ".nv3.count") >= 80){
  $this->main->nv->setNested($player->getName() . ".nv", false);
  $this->main->nv->setNested($player->getName() . ".nv3.check", false);
  $this->main->nv->setNested($player->getName() . ".nv3.count", 0);
  $this->main->nv->setNested($player->getName() . ".time", $this->main->getConfig()->get("time"));
  $this->main->nv->setNested($player->getName() . ".timecheck", true);
       $this->main->nv->setNested($player->getName() . ".top", ($this->main->nv->getNested($player->getName() . ".top") + 1));
  $this->main->nv->save();
  EconomyAPI::getInstance()->addMoney($player, $this->main->getConfig()->getNested("money.nv3"));
  $player->sendTitle("§l§aĐÃ HOÀN THÀNH NHIỆM VỤ", "§l§eTHƯỞNG " . ($this->main->getConfig()->getNested("money.nv3")) . " Xu");
  }
  }
  }
  if($block->getId() === 17 and $block->getMeta() === 0){
  if($this->main->nv->getNested($player->getName() . ".nv4.check") === true){
  $this->main->nv->setNested($player->getName() . ".nv4.count", ($this->main->nv->getNested($player->getName() . ".nv4.count") + 1));
  $this->main->nv->save();
  $player->sendPopup("§aTiến trình nhiệm vụ: §7" . ($this->main->nv->getNested($player->getName() . ".nv4.count")) . "§e/§c70");
  if($this->main->nv->getNested($player->getName() . ".nv4.count") >= 70){
  $this->main->nv->setNested($player->getName() . ".nv", false);
  $this->main->nv->setNested($player->getName() . ".nv4.check", false);
  $this->main->nv->setNested($player->getName() . ".nv4.count", 0);
  $this->main->nv->setNested($player->getName() . ".time", $this->main->getConfig()->get("time"));
  $this->main->nv->setNested($player->getName() . ".timecheck", true);
     $this->main->nv->setNested($player->getName() . ".top", ($this->main->nv->getNested($player->getName() . ".top") + 1));
  $this->main->nv->save();
  EconomyAPI::getInstance()->addMoney($player, $this->main->getConfig()->getNested("money.nv4"));
  $player->sendTitle("§l§aĐÃ HOÀN THÀNH NHIỆM VỤ", "§l§eTHƯỞNG " . ($this->main->getConfig()->getNested("money.nv4")) . " Xu");
  }
  }
  }
  }
  }
  
  public function onDamage(EntityDamageEvent $event){
  $entity = $event->getEntity();
  if(!$event->isCancelled()){
  if($entity instanceof Living){
  if($event->getFinalDamage() >= $entity->getHealth()){
  if($event instanceof EntityDamageByEntityEvent){
  $damager = $event->getDamager();
  if($damager instanceof Player){
  if($this->main->nv->getNested($damager->getName() . ".nv2.check") === true){
  $this->main->nv->setNested($damager->getName() . ".nv2.count", ($this->main->nv->getNested($damager->getName() . ".nv2.count") + 1));
  $this->main->nv->save();
  $damager->sendPopup("§aTiến trình nhiệm vụ: §7" . ($this->main->nv->getNested($damager->getName() . ".nv2.count")) . "§e/§c20");
  if($this->main->nv->getNested($damager->getName() . ".nv2.count") >= 20){
  $this->main->nv->setNested($damager->getName() . ".nv", false);
  $this->main->nv->setNested($damager->getName() . ".nv2.check", false);
  $this->main->nv->setNested($damager->getName() . ".nv2.count", 0);
  $this->main->nv->setNested($damager->getName() . ".time", $this->main->getConfig()->get("time"));
  $this->main->nv->setNested($damager->getName() . ".timecheck", true);
   $this->main->nv->setNested($damager->getName() . ".top", ($this->main->nv->getNested($damager->getName() . ".top") + 1));
  $this->main->nv->save();
  EconomyAPI::getInstance()->addMoney($damager, $this->main->getConfig()->getNested("money.nv2"));
  $damager->sendTitle("§l§aĐÃ HOÀN THÀNH NHIỆM VỤ", "§l§eTHƯỞNG " . ($this->main->getConfig()->getNested("money.nv2")) . " Xu");
  }
  }
  }
  }
  }
  }
  }
  }
}
