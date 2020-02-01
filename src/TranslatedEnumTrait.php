<?php
namespace GollumSF\Enum;

trait TranslatedEnumTrait {
	use EnumTrait;
	
	public static function getTranslatedEnums(): array {
		$list = [];
		$closure = TranslatedEnum::getCallbackTranslatedValue();
		if (!$closure) {
			$closure = function ($className, $key, $value) {
				$path = str_replace('\\', '.', $className);
				$path = substr($path, 0, strrpos($path, '.'));
				$path = $path ? $path.'.' : '';
				return strtolower((preg_replace('/([a-z])([A-Z])/', '$1_$2', $path)).(preg_replace('/([a-z])([A-Z])/', '$1_$2', $key)));
			};
		}
		foreach (self::getEnums() as $key => $value) {
		 	$list[$key] = $closure(get_called_class(), $key, $value);
		}
		return $list;
	}

	public static function getTranslatedValues(): array {
		return array_values(self::getTranslatedEnums());
	}

	public static function isTranslatedValid($value): bool {
		return in_array($value, static::getTranslatedEnums(), true);
	}

	public static function translatedSearch($value): ?string {
		$enums = static::getTranslatedEnums();
		if (in_array($value, $enums)) {
			return  \array_search($value, $enums, true);
		}
		return null;
	}
}