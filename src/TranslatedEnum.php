<?php
namespace GollumSF\Enum;

abstract class TranslatedEnum implements TranslatedEnumInterface {
	use TranslatedEnumTrait;

	/** @var  \Closure */
	private static $callbackTranslatedValue = null;

	public static function getCallbackTranslatedValue(): ?\Closure {
		return self::$callbackTranslatedValue;
	}

	public static function setCallbackTranslatedValue(?\Closure $generateTranslateKey): void {
		self::$callbackTranslatedValue = $generateTranslateKey;
	}
}