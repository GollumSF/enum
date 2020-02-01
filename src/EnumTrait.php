<?php
namespace GollumSF\Enum;

trait EnumTrait {
	
	public static function getEnums(): array {
		$rClass = new \ReflectionClass(get_called_class());
		return $rClass->getConstants();
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
	
	public static function search($value): ?string {
		$enums = static::getEnums();
		if (in_array($value, $enums)) {
			return  \array_search($value, $enums, true);
		}
		return null;
	}
}
