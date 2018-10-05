<?php
namespace GollumSF\Enum;

interface EnumInterface {
	public static function getEnums(): array;
	public static function getKeys(): array;
	public static function getValues(): array;
	public static function isValid($value): bool;
	public static function isValidKey(string $key): bool;
	public static function search($value): string;
}