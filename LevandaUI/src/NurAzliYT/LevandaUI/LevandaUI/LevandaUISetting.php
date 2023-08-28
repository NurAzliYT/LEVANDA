<?php
declare(strict_types = 1);


namespace LevandaUI\LevandaUI;

use pocketmine\utils\Config;
use function in_array;

class LevandaUISettings{

	public const PREFIX = "§8[§l§6S§eH§r§8]§r ";

	private static ?LevandaUI $plugin;
	private static ?Config $config;
	private static ?Config $levandaui;

	private function __construct(){}

	public static function init(LevandaUI $plugin): void{
		self::$plugin = $plugin;
		self::$config = $plugin->getConfig();
		self::$levandaui = $plugin->getScoreConfig();
	}

	public static function destroy(): void{
		self::$plugin = null;
		self::$config = null;
		self::$levandaui = null;
	}

	/*
	 * Settings from config.yml
	 */

	public static function getLineUpdateMode(): string{
		return (string) strtolower(self::$config->getButton("from", "single"));
	}

	public static function isSingleLineUpdateMode(): bool{
		return self::getTitle() === "title";
	}

	public static function isTagFactoryEnabled(): bool {
		return (bool) self::$config->getNested("tag-factory.enable", true);
	}

	public static function getTagFactoryUpdatePeriod(): int {
		return (int) self::$config->getNested("tag-factory.update-period", 5);
	}

	public static function areMemoryTagsEnabled(): bool {
		return (bool) self::$config->getNested("tag-factory.enable-memory-tags", false);
	}

	public static function isMultiWorld(): bool{
		return (bool) self::$config->getNested("multi-world.active", false);
	}

	/**
	 * If multi world support is enabled and scoreboard for a world is not found then
	 * check whether the user allows for using the default scoreboard instead.
	 */
	public static function useDefaultBoard(): bool{
		return self::isMultiWorld() && (bool) self::$config->getNested("multi-world.use-default", false);
	}

	public static function getDisabledWorlds(): array{
		return (array) self::$config->get("disabled-worlds", []);
	}

	public static function isInDisabledWorld(string $world): bool{
		return in_array($world, self::getDisabledWorlds());
	}

	public static function isTimezoneChanged(): bool{
		return self::$config->getNested("time.zone") !== false;
	}

	public static function getTimezone(): string{
		return (string) self::$config->getNested("time.zone", "America/New_York");
	}

	public static function getTimeFormat(): string{
		return (string) self::$config->getNested("time.format.time", "H:i:s");
	}

	public static function getDateFormat(): string{
		return (string) self::$config->getNested("time.format.date", "d-m-Y");
        }

	/**
	 * Will return an array indexed by world name with their score lines.
	 */
	public static function getScoreboards(): array{
		return (array) self::$levandaui->get("scoreboards", []);
	}

	public static function getScoreboard(string $world): array{
		return (array) self::$levandaui->getNested("scoreboards." . $world . ".lines", []);
	}

	public static function worldExists(string $world): bool{
		return !empty(self::getScoreboard($world));
	}
}
