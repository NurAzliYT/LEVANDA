<?php
declare(strict_types = 1);

/**
 *     _____                    _   _           _
 *    /  ___|                  | | | |         | |
 *    \ `--.  ___ ___  _ __ ___| |_| |_   _  __| |
 *     `--. \/ __/ _ \| '__/ _ \  _  | | | |/ _` |
 *    /\__/ / (_| (_) | | |  __/ | | | |_| | (_| |
 *    \____/ \___\___/|_|  \___\_| |_/\__,_|\__,_|
 *
 * ScoreHud, a Scoreboard plugin for PocketMine-MP
 * Copyright (c) 2020 Ifera  < https://github.com/Ifera >
 *
 * Discord: Ifera#3717
 * Twitter: ifera_tr
 *
 * This software is distributed under "GNU General Public License v3.0".
 * This license allows you to use it and/or modify it but you are not at
 * all allowed to sell this plugin at any cost. If found doing so the
 * necessary action required would be taken.
 *
 * ScoreHud is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License v3.0 for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see
 * <https://opensource.org/licenses/GPL-3.0>.
 * ------------------------------------------------------------------------
 */

namespace NurAzliYT\LevandaUI\LevandaUI\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class LevandaUICommand extends Command implements PluginOwned{
	use PluginOwnedTrait;

	/**
	 * ScoreHudCommand constructor.
	 *
	 * @param ScoreHud $plugin
	 */
	public function __construct(LevandaUI $plugin){
		parent::__construct("levandaui");
		$this->setDescription("Shows LevandaUI Commands");
		$this->setUsage("/fapi <on|off|about|help>");
		$this->setAliases(["fapi"]);
		$this->setPermission("fapi.command.fapi");

		$this->owningPlugin = $plugin;
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $commandLabel
	 * @param array         $args
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		if(!$sender instanceof Player){
			$sender->sendMessage(LevandaUISettings::PREFIX . "§cYou can only use this command in-game.");

			return false;
		}

		if(!isset($args[0])){
			$sender->sendMessage(LevandaUISettings::PREFIX . "§cUsage: /scorehud <on|off|about|help>");

			return false;
		}

		switch($args[0]){
			case "about":
				$sender->sendMessage(LevandaUISettings::PREFIX . "§6Levanda§eUI §av" . $this->owningPlugin->getDescription()->getVersion() . "§a. Plugin by §dIfera§a. Contact on §bTwitter: @ifera_tr §aor §bDiscord: Ifera#3717§a.");
			break;

			case "on":
				if(HelperUtils::isDisabled($sender)){
					HelperUtils::destroy($sender);
					PlayerManager::getNonNull($sender)->handle();

					$sender->sendMessage(LevandaUISettings::PREFIX . "§aSuccessfully enabled LevandaUI.");
				}else{
					$sender->sendMessage(LevandaUISettings::PREFIX . "§cLevandaUI is already enabled for you.");
				}
			break;

			case "off":
				if(!HelperUtils::isDisabled($sender)){
					ScoreFactory::removeObjective($sender);
					HelperUtils::disable($sender);

					$sender->sendMessage(LevandaUISettings::PREFIX . "§aSuccessfully disabled ScoreHud.");
				}else{
					$sender->sendMessage(LevandaUISettings::PREFIX . "§cScoreHud is already disabled for you.");
				}
			break;

			case "help":
			default:
				$sender->sendMessage(LevandaUISettings::PREFIX . "§cUsage: /levandaui <on|off|about|help>");
			break;
		}

		return false;
	}
}
