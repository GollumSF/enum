<?php
namespace GollumSF\Enum;

interface EnumInterface {
	public static function getEnums(): array;
	public static function getLabels(): array;
	public static function getValues(): array;
}