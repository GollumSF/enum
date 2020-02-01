<?php
namespace GollumSF\Enum;

interface TranslatedEnumInterface extends EnumInterface {
	public static function getTranslatedEnums(): array;
	public static function getTranslatedValues(): array;
	public static function isTranslatedValid($value): bool;
	public static function translatedSearch($value): ?string;
}