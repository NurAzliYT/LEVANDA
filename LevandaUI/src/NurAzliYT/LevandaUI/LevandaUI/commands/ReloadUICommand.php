<?php
namespace pocketmine\command;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class ReloadUICommand extends Command {

    public function __construct(string $name) {
        parent::__construct($name, "Memuat ulang UI Form", "/reloadui");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender instanceof ConsoleCommandSender || $sender->isOp()) {
            // Tambahkan kode untuk memuat ulang UI Form di sini.
            $sender->sendMessage("UI Form telah dimuat ulang.");
        } else {
            $sender->sendMessage("Anda tidak memiliki izin untuk menjalankan perintah ini.");
        }
    }
}
