<?php
namespace GollumSF\Enum;

interface TranslatedEnumInterface extends EnumInterface {
	public static getTranslatedKeysValue(): array;
}