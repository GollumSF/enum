<?php
namespace Test\GollumSF\Enum;

use GollumSF\Enum\TranslatedEnum;
use GollumSF\Enum\TranslatedEnumInterface;
use GollumSF\Enum\TranslatedEnumTrait;
use PHPUnit\Framework\TestCase;
use function foo\func;

class TransEnum1 extends TranslatedEnum {
	const KEY1_1 = 'VALUE1_1';
	const KEY1_2 = 'VALUE1_2';
	const KEY1_3 = 'VALUE1_3';
	const KEY1_4 = 'VALUE1_4';
}

class TransEnum2 implements TranslatedEnumInterface {
	use TranslatedEnumTrait;

	const KEY2_1 = 'VALUE2_1';
	const KEY2_2 = 'VALUE2_2';
	const KEY2_3 = 'VALUE2_3';
	const KEY2_4 = 'VALUE2_4';
}

class TransEnum3 extends TransEnum1 {
	const KEY3_5 = 'VALUE3_5';
}

class TranslatedEnumTest extends TestCase {

	public function testGetTranslatedEnums() {

		$this->assertEquals(TransEnum1::getTranslatedEnums(), [
			'KEY1_1' => 'test.gollum_sf.enum.key1_1',
			'KEY1_2' => 'test.gollum_sf.enum.key1_2',
			'KEY1_3' => 'test.gollum_sf.enum.key1_3',
			'KEY1_4' => 'test.gollum_sf.enum.key1_4',
		]);
		$this->assertEquals(TransEnum2::getTranslatedEnums(), [
			'KEY2_1' => 'test.gollum_sf.enum.key2_1',
			'KEY2_2' => 'test.gollum_sf.enum.key2_2',
			'KEY2_3' => 'test.gollum_sf.enum.key2_3',
			'KEY2_4' => 'test.gollum_sf.enum.key2_4',
		]);
		$this->assertEquals(TransEnum3::getTranslatedEnums(), [
			'KEY3_5' => 'test.gollum_sf.enum.key3_5',
			'KEY1_1' => 'test.gollum_sf.enum.key1_1',
			'KEY1_2' => 'test.gollum_sf.enum.key1_2',
			'KEY1_3' => 'test.gollum_sf.enum.key1_3',
			'KEY1_4' => 'test.gollum_sf.enum.key1_4',
		]);
	}

	public function testGetTranslatedValue() {

		$this->assertEquals(TransEnum1::getTranslatedValues(), [
			'test.gollum_sf.enum.key1_1',
			'test.gollum_sf.enum.key1_2',
			'test.gollum_sf.enum.key1_3',
			'test.gollum_sf.enum.key1_4',
		]);
		$this->assertEquals(TransEnum2::getTranslatedValues(), [
			'test.gollum_sf.enum.key2_1',
			'test.gollum_sf.enum.key2_2',
			'test.gollum_sf.enum.key2_3',
			'test.gollum_sf.enum.key2_4',
		]);
		$this->assertEquals(TransEnum3::getTranslatedValues(), [
			'test.gollum_sf.enum.key3_5',
			'test.gollum_sf.enum.key1_1',
			'test.gollum_sf.enum.key1_2',
			'test.gollum_sf.enum.key1_3',
			'test.gollum_sf.enum.key1_4',
		]);
	}

	public function testIsTranslatedValid() {
		$this->assertTrue(TransEnum1::isTranslatedValid('test.gollum_sf.enum.key1_1'));
		$this->assertTrue(TransEnum1::isTranslatedValid('test.gollum_sf.enum.key1_2'));
		$this->assertTrue(TransEnum1::isTranslatedValid('test.gollum_sf.enum.key1_3'));
		$this->assertTrue(TransEnum1::isTranslatedValid('test.gollum_sf.enum.key1_4'));
		$this->assertFalse(TransEnum1::isTranslatedValid('BAD'));

		$this->assertTrue(TransEnum2::isTranslatedValid('test.gollum_sf.enum.key2_1'));
		$this->assertTrue(TransEnum2::isTranslatedValid('test.gollum_sf.enum.key2_2'));
		$this->assertTrue(TransEnum2::isTranslatedValid('test.gollum_sf.enum.key2_3'));
		$this->assertTrue(TransEnum2::isTranslatedValid('test.gollum_sf.enum.key2_4'));
		$this->assertFalse(TransEnum2::isTranslatedValid('BAD'));

		$this->assertTrue(TransEnum3::isTranslatedValid('test.gollum_sf.enum.key1_1'));
		$this->assertTrue(TransEnum3::isTranslatedValid('test.gollum_sf.enum.key1_2'));
		$this->assertTrue(TransEnum3::isTranslatedValid('test.gollum_sf.enum.key1_3'));
		$this->assertTrue(TransEnum3::isTranslatedValid('test.gollum_sf.enum.key1_4'));
		$this->assertTrue(TransEnum3::isTranslatedValid('test.gollum_sf.enum.key3_5'));
		$this->assertFalse(TransEnum3::isTranslatedValid('BAD'));
	}

	public function testSearch() {
		$this->assertEquals(TransEnum1::translatedSearch('test.gollum_sf.enum.key1_1'), 'KEY1_1');
		$this->assertEquals(TransEnum1::translatedSearch('test.gollum_sf.enum.key1_2'), 'KEY1_2');
		$this->assertEquals(TransEnum1::translatedSearch('test.gollum_sf.enum.key1_3'), 'KEY1_3');
		$this->assertEquals(TransEnum1::translatedSearch('test.gollum_sf.enum.key1_4'), 'KEY1_4');
		$this->assertNull(TransEnum1::translatedSearch('BAD'));

		$this->assertEquals(TransEnum2::translatedSearch('test.gollum_sf.enum.key2_1'), 'KEY2_1');
		$this->assertEquals(TransEnum2::translatedSearch('test.gollum_sf.enum.key2_2'), 'KEY2_2');
		$this->assertEquals(TransEnum2::translatedSearch('test.gollum_sf.enum.key2_3'), 'KEY2_3');
		$this->assertEquals(TransEnum2::translatedSearch('test.gollum_sf.enum.key2_4'), 'KEY2_4');
		$this->assertNull(TransEnum2::translatedSearch('BAD'));

		$this->assertEquals(TransEnum3::translatedSearch('test.gollum_sf.enum.key1_1'), 'KEY1_1');
		$this->assertEquals(TransEnum3::translatedSearch('test.gollum_sf.enum.key1_1'), 'KEY1_1');
		$this->assertEquals(TransEnum3::translatedSearch('test.gollum_sf.enum.key1_1'), 'KEY1_1');
		$this->assertEquals(TransEnum3::translatedSearch('test.gollum_sf.enum.key1_1'), 'KEY1_1');
		$this->assertEquals(TransEnum3::translatedSearch('test.gollum_sf.enum.key3_5'), 'KEY3_5');
		$this->assertNull(TransEnum2::translatedSearch('BAD'));
	}
	public function testCallbackTranslatedValue() {

		TranslatedEnum::setCallbackTranslatedValue(function ($className, $key, $value) {
			return $className.'.'.$key.'.'.$value;
		});
		
		$this->assertEquals(TransEnum1::getTranslatedEnums(), [
			'KEY1_1' => TransEnum1::class.'.KEY1_1.VALUE1_1',
			'KEY1_2' => TransEnum1::class.'.KEY1_2.VALUE1_2',
			'KEY1_3' => TransEnum1::class.'.KEY1_3.VALUE1_3',
			'KEY1_4' => TransEnum1::class.'.KEY1_4.VALUE1_4',
		]);
		$this->assertEquals(TransEnum2::getTranslatedEnums(), [
			'KEY2_1' => TransEnum2::class.'.KEY2_1.VALUE2_1',
			'KEY2_2' => TransEnum2::class.'.KEY2_2.VALUE2_2',
			'KEY2_3' => TransEnum2::class.'.KEY2_3.VALUE2_3',
			'KEY2_4' => TransEnum2::class.'.KEY2_4.VALUE2_4',
		]);
		$this->assertEquals(TransEnum3::getTranslatedEnums(), [
			'KEY3_5' => TransEnum3::class.'.KEY3_5.VALUE3_5',
			'KEY1_1' => TransEnum3::class.'.KEY1_1.VALUE1_1',
			'KEY1_2' => TransEnum3::class.'.KEY1_2.VALUE1_2',
			'KEY1_3' => TransEnum3::class.'.KEY1_3.VALUE1_3',
			'KEY1_4' => TransEnum3::class.'.KEY1_4.VALUE1_4',
		]);
	}
	
}