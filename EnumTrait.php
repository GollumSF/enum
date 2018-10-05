<?php
namespace GollumSF\Enum;

trait EnumTrait {
	
	private static $enums = null;
	
	public static function getEnums(): array {
		if (self::$enums === null) {
			$rClass = new \ReflectionClass(get_called_class());
			self::$enums = $rClass->getConstants();
		}
		return self::$enums;
	}
	
	public static function getKeys(): array {
		return array_keys(self::getEnums());
	}
	
	public static function getValues(): array {
		return array_values(self::getEnums());
	}
	
	public static function isValid($value): bool {
		return in_array($value, static::getEnums(), true);
	}
	
	public static function isValidKey(string $key): bool {
		return \array_key_exists($key, static::getEnums());
	}
	
	public static function search($value): string {
		return \array_search($value, static::getEnums(), true);
	}
}