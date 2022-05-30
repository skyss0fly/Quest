<?php

namespace NhanOfficial\nhiemvu;

use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use NhanOfficial\nhiemvu\Main;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;

class FormCommand extends Command implements PluginOwned{
  
  /** @var Main $main*/
  private $main;
  
  public function __construct(Main $main){
    $this->main = $main;
    parent::__construct("quest", "open menu quest", null, ["nhiemvu", "nv"]);
    $this->setPermission("nhiemvu.use.command");
  }
  
  public function execute(CommandSender $player, String $label, array $args): bool{
    if($player instanceof Player){
    if($this->testPermission($player)){
    $this->mainForm($player);
    }
    }
    return true;
  }
  
  private function mainForm(Player $player){
  $form = new SimpleForm(function(Player $player, int $data = null){

   if($data === null){
     return true;
   }
   switch($data){
   case 0:
   $this->listNv($player);
   break;
   
   case 1:
   $this->Top($player);
   break;
   }
  });
  if($this->main->nv->getNested($player->getName() . ".nv") === false){
  if($this->main->nv->getNested($player->getName() . ".timecheck") === false){
  $status = "Đang không làm gì";
  }else{
  $status = "Đang trong thời gian hồi";
  }
  }else{
  if($this->main->nv->getNested($player->getName() . ".nv1.check") === true){
  $status = "Đang làm nhiệm vụ [ Đào Khối ]";
  }
  if($this->main->nv->getNested($player->getName() . ".nv2.check") === true){
  $status = "Đang làm nhiệm vụ [ Giết Quái ]";
  }
  if($this->main->nv->getNested($player->getName() . ".nv3.check") === true){
  $status = "Đang làm nhiệm vụ [ Thu Hoạch Lúa ]";
  }
  if($this->main->nv->getNested($player->getName() . ".nv4.check") === true){
  $status = "Đang làm nhiệm vụ [ Thu Hoạch Gỗ ]";
  }
  }
  $form->setTitle("§c▰ §bNhiệm Vụ §c▰");
  $form->setContent("§c§l» §r§7Trạng thái của bạn: $status");
  $form->addButton("§l§c• §9Danh Sách Nhiệm Vụ §c•", 0, "plugins/Nhiemvu/icon/list.png");
  $form->addButton("§l§c• §9Top Nhiệm Vụ §c•", 0, "plugins/Nhiemvu/icon/top.png");
  $form->sendToPlayer($player);
  return $form;
  }
  
  private function listNv(Player $player){
  $form = new SimpleForm(function(Player $player, int $data = null){
    
    if($data === null){
    $this->mainForm($player);
    return true;
    }
  switch($data){
  case 0:
  if($this->main->nv->getNested($player->getName() . ".timecheck") === false){
  if($this->main->nv->getNested($player->getName() . ".nv") === false){
  $this->nv1($player);
  }else{
  $player->sendMessage("§c§l● §eBạn đang làm một nhiệm vụ rồi, hãy làm xong nhiệm vụ đó");
  }
  }else{
  $player->sendMessage("§c§l● §eBạn đã làm một nhiệm vụ trước đó, bạn còn §e" . ($this->main->nv->getNested($player->getName() . ".time")) . "§c giây nữa");
  }
  break;
  
  case 1:
  if($this->main->nv->getNested($player->getName() . ".timecheck") === false){
  if($this->main->nv->getNested($player->getName() . ".nv") === false){
  $this->nv2($player);
  }else{
  $player->sendMessage("§c§l● §eBạn đang làm một nhiệm vụ rồi, hãy làm xong nhiệm vụ đó");
  }
  }else{
  $player->sendMessage("§c§l● §eBạn đã làm một nhiệm vụ trước đó, bạn còn §e" . ($this->main->nv->getNested($player->getName() . ".time")) . "§c giây nữa");
  }
  break;
  
  case 2:
  if($this->main->nv->getNested($player->getName() . ".timecheck") === false){
  if($this->main->nv->getNested($player->getName() . ".nv") === false){
  $this->nv3($player);
  }else{
  $player->sendMessage("§c§l● §eBạn đang làm một nhiệm vụ rồi, hãy làm xong nhiệm vụ đó");
  }
  }else{
  $player->sendMessage("§c§l● §eBạn đã làm một nhiệm vụ trước đó, bạn còn §e" . ($this->main->nv->getNested($player->getName() . ".time")) . "§c giây nữa");
  }
  break;
  
  case 3:
  if($this->main->nv->getNested($player->getName() . ".timecheck") === false){
  if($this->main->nv->getNested($player->getName() . ".nv") === false){
  $this->nv4($player);
  }else{
  $player->sendMessage("§c§l● §eBạn đang làm một nhiệm vụ rồi, hãy làm xong nhiệm vụ đó");
  }
  }else{
  $player->sendMessage("§c§l● §eBạn đã làm một nhiệm vụ trước đó, bạn còn §e" . ($this->main->nv->getNested($player->getName() . ".time")) . "§c giây nữa");
  }
  break;
  }
  });
  $nv1 = [];
  $nv2 = [];
  $nv3 = [];
  $nv4 = [];
  foreach($this->main->nv->getAll() as $name => $data){
  if($data["nv1"]["check"] === true){
  $nv1[] = $name;
  }
  if($data["nv2"]["check"] === true){
  $nv2[] = $name;
  }
  if($data["nv3"]["check"] === true){
  $nv3[] = $name;
  }
  if($data["nv4"]["check"] === true){
  $nv4[] = $name;
  }
  }
  $form->setTitle("
§c▰ §bDanh Sách Nhiệm Vụ §c▰");
  $form->addButton("§l§c• §9Đào Khối §c•\n§7Hiện đang có §e" . count($nv1) . "§7 người đang làm", 0, "plugins/Nhiemvu/icon/mining.png");
  $form->addButton("§l§c• §9Giết Quái §c•\n§7Hiện đang có §e" . count($nv2) . "§7 người đang làm", 0, "plugins/Nhiemvu/icon/stabber.png");
  $form->addButton("§l§c• §9Thu Hoạch Lúa §c•\n§7Hiện đang có §e" . count($nv3) . "§7 người đang làm", 0, "plugins/Nhiemvu/icon/wheat.png");
  $form->addButton("§l§c• §9Chặt Gỗ §c• \n§7Hiện đang có §e" . count($nv4) . "§7 người đang làm", 0, "plugins/Nhiemvu/icon/wood.png");
  $form->sendToPlayer($player);
  return $form;
  }
  
  private function nv1(Player $player){
  $form = new ModalForm(function(Player $player, $data){
   
   if($data === null){
   $this->listNv($player);
   return true;
   }
   switch($data){
   case 1:
   $this->main->nv->setNested($player->getName() . ".nv", true);
   $this->main->nv->setNested($player->getName() . ".nv1.check", true);
   $this->main->nv->save();
   $player->sendTitle("§c§l● §eĐÃ CHẤP NHẬN NHIỆM VỤ", "§l§eĐÀO KHỐI: 100 Blocks");
   break;
   
   case 2:
   $this->listNv($player);
   break;
   }
  });
  $form->setTitle("§c▰ §bĐào Khối §c▰");
  $form->setContent("§c§l» §r§7Bạn có muốn làm nhiệm vụ §7Đào Khối§a với tiêu chí là: §c100 Blocks\n§aPhần thưởng: §c" . ($this->main->getConfig()->getNested("money.nv1")) . "§a Xu");
  $form->setButton1("§l§c• §9Đồng Ý §c•");
  $form->setButton2("§l§c• §9Từ Chối §c•");
  $form->sendToPlayer($player);
  return $form;
  }
  
  private function nv2(Player $player){
  $form = new ModalForm(function(Player $player, $data){
   
   if($data === null){
   $this->listNv($player);
   return true;
   }
   switch($data){
   case 1:
   $this->main->nv->setNested($player->getName() . ".nv", true);
   $this->main->nv->setNested($player->getName() . ".nv2.check", true);
   $this->main->nv->save();
   $player->sendTitle("§c§l● §eĐÃ CHẤP NHẬN NHIỆM VỤ", "§l§eGIẾT QUÁI: 20 Quái");
   break;
   
   case 2:
   $this->listNv($player);
   break;
   }
  });
  $form->setTitle("§c▰ §bGiết Quái §c▰");
  $form->setContent("§aBạn có muốn làm nhiệm vụ §7Giết Quái§a với tiêu chí là: §c20 Quái\n§aPhần thưởng: §c" . ($this->main->getConfig()->getNested("money.nv2")) . "§a Xu");
  $form->setButton1("§l§c• §9Đồng Ý §c•");
  $form->setButton2("§l§c• §9Từ Chối §c•");
  $form->sendToPlayer($player);
  return $form;
  }
  
  private function nv3(Player $player){
  $form = new ModalForm(function(Player $player, $data){
   
   if($data === null){
   $this->listNv($player);
   return true;
   }
   switch($data){
   case 1:
   $this->main->nv->setNested($player->getName() . ".nv", true);
   $this->main->nv->setNested($player->getName() . ".nv3.check", true);
   $this->main->nv->save();
   $player->sendTitle("§c§l» §r§7ĐÃ CHẤP NHẬN NHIỆM VỤ", "§l§eTHU HOẠCH LÚA: 80 Lúa");
   break;
   
   case 2:
   $this->listNv($player);
   break;
   }
  });
  $form->setTitle("§c▰ §bThu Hoạch Lúa §c▰");
  $form->setContent("§c§l» §r§7Bạn có muốn làm nhiệm vụ §7Thu Hoạch Lúa§a với tiêu chí là: §c80 Lúa\n§aPhần thưởng: §c" . ($this->main->getConfig()->getNested("money.nv3")) . "§a Xu");
  $form->setButton1("§l§c• §9Đồng Ý §c•");
  $form->setButton2("§l§c• §9Từ Chối §c•");
  $form->sendToPlayer($player);
  return $form;
  }
  
  private function nv4(Player $player){
  $form = new ModalForm(function(Player $player, $data){
   
   if($data === null){
   $this->listNv($player);
   return true;
   }
   switch($data){
   case 1:
   $this->main->nv->setNested($player->getName() . ".nv", true);
   $this->main->nv->setNested($player->getName() . ".nv4.check", true);
   $this->main->nv->save();
   $player->sendTitle("§c§l» §r§7ĐÃ CHẤP NHẬN NHIỆM VỤ", "§l§eTHU HOẠCH GỖ SỒI: 70 Gỗ Sồi");
   break;
   
   case 2:
   $this->listNv($player);
   break;
   }
  });
  $form->setTitle("§c▰ §bChặt Gỗ §c▰");
  $form->setContent("§c§l» §r§7Bạn có muốn làm nhiệm vụ §7Thu Hoạch Gỗ Sồi§a với tiêu chí là: §c70 Gỗ Sồi\n§aPhần thưởng: §c" . ($this->main->getConfig()->getNested("money.nv4")) . "§a Xu");
  $form->setButton1("§l§c• §9Đồng Ý §c•");
  $form->setButton2("§l§c• §9Từ Chối §c•");
  $form->sendToPlayer($player);
  return $form;
  }
    
    public function Top(Player $player){

  $form = new CustomForm(function(Player $player, array $data = null){

    

    if($data === null){

      return true;

    }

  });

  $txt = "";

  $array = [];

  foreach($this->main->nv->getAll() as $name => $data){

  $score = $data["top"];

  $array[$name] = $score;

  }

  arsort($array);

  $array = array_slice($array, 0, 5);

  $top = 1;

  foreach($array as $name => $score){

  $txt .= "§c§l» §r§7$top $name $score";

  $top++;

  }

  $form->setTitle("§c▰ §bTop Nhiệm Vụ §c▰");

  $form->addLabel($txt);

  $form->sendToPlayer($player);

  return $form;

  }
  
  public function getOwningPlugin() : Plugin{
   return $this->main;
  }
}


