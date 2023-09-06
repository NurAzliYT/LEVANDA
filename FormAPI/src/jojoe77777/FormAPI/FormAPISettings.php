<?php

namespace jojoe77777\FormAPI\FormAPISettings;

use pocketmine\utils\Config;
use function in_array;

class FormAPISettings{
  
	private static ?FormAPI $plugin;
	private static ?Config $config;
	private static ?Config $formapi;

	private function __construct(){}

	public static function init(FormAPI $plugin): void{
		self::$plugin = $plugin;
		self::$config = $plugin->getConfig();
		self::$formapi= $plugin->getFormConfig();
	}

	public static function destroy(): void{
		self::$plugin = null;
		self::$config = null;
		self::$formapi = null;
  }
}
