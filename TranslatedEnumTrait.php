<?php
namespace GollumSF\Enum;

trait TranslatedEnumTrait {
	use EnumTrait;
	
	public static function getTranslatedKeysValue(): array {
		$list = [];
		$path = str_replace('\\', '.', get_called_class());
		$path = substr($path, 0, strrpos($path, '.'));
		$path = $path ? $path.'.' : '';
		$path = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', '_$1', $path));
		
		foreach (self::getEnums() as $key => $value) {
		 	$list[$key] = $path.strtolower($key);
		}
		return $list;
	}
}