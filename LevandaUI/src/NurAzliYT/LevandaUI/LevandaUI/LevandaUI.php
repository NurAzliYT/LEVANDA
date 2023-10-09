<?php

namespace NurAzliYT\LevandaUI\LevandaUI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\item\VanillaItems;
use jojoe77777\FormAPI\SimpleForm;

class LevandaUI extends PluginBase{

    public function onEnable(): void {

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

        if ($command->getName() == "levandaui") {
            if ($sender instanceof Player) {
                $this->onSimpleForm($sender);
            }
        }
        return true;
    }

    public function onSimpleForm(Player $player): void {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    $inv = $player->getInventory();
                    $inv->setItem(0, VanillaItems::DIAMOND()->setCount(64));
                    $player->sendMessage("Kamu Telah Mendapatkan 64 Berlian!");
                    break;
                case 1:
                    $inv = $player->getInventory();
                    $inv->setItem(0, VanillaItems::GOLD_INGOT()->setCount(43));
                    $player->sendMessage("Kamu Telah Mendapatkan 43 Gold!");
                    break;
            }
        });
        $form->setTitle("LevandaUI");
        $form->setContent("Claim Your Rewards");
        $form->addButton("OK");
        $form->addButton("Cancel"); // Changed "Buttom" to "Button"
        $player->sendForm($form);
    }
}
