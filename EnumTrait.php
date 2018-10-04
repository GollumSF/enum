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
	
	public static function getLabels(): array {
		return array_keys(self::getEnums());
	}
	
	public static function getValues(): array {
		return array_values(self::getEnums());
	}

}