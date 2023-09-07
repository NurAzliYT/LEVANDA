<?php

namespace NurAzliYT\LevandaUI\LevandaUI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\item\VanillaItems;
use jojoe77777\FormAPI\SimpleForm;

class LevandaUI extends PluginBase{
    
    public function onEnable():void{

    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool{

        if($command->getName() == "levandaui"){
            if($sender instanceof Player){
                $this->onSimpleForm($sender);
            }
        }
        return true;
    }

  public function onSimpleForm(Player $player):void{
      $form = new SimpleForm(function (Player $player, $data){
          if(!isset($data)){
              return;
          }
          switch ($data){
              case 0;
                  $inv = $player->getinventory();
                  $inv->setitem(index: 0, VanillaItems::DIAMOND()->setCount(64));
                  $player->SendMessage("Kamu Telah Mendapatkan 64 Berlian!");
                  break;
              case 1;
                  $inv = $player->getinventory();
                  $inv->setitem(index: 0, VanillaItems::DIAMOND_ORE()->setCount(43));
                  $player->SendMessage("Kamu Telah Mendapatkan 64 Berlian Metah!");
                  break;
          }
      });
      $form->setTitle("LevandaUI");
      $form->setContent("Claim Your Rewards");
      $form->addButton("OK");
      $form->addButtom("Cencel");
      $player->sendForm($form);
  }
}
