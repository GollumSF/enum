<?php
namespace Test\GollumSF\Enum;

use GollumSF\Enum\Enum;
use GollumSF\Enum\EnumInterface;
use GollumSF\Enum\EnumTrait;
use PHPUnit\Framework\TestCase;

class Enum1 extends Enum {
	const KEY1_1 = 'VALUE1_1';
	const KEY1_2 = 'VALUE1_2';
	const KEY1_3 = 'VALUE1_3';
	const KEY1_4 = 'VALUE1_4';
}

class Enum2 implements EnumInterface {
	use EnumTrait;
	
	const KEY2_1 = 'VALUE2_1';
	const KEY2_2 = 'VALUE2_2';
	const KEY2_3 = 'VALUE2_3';
	const KEY2_4 = 'VALUE2_4';
}

class Enum3 extends Enum1 {
	const KEY3_5 = 'VALUE3_5';
}

class EnumTest extends TestCase {
	
	public function testGetEnums() {
		$this->assertEquals(Enum1::getEnums(), [
			'KEY1_1' => 'VALUE1_1',
			'KEY1_2' => 'VALUE1_2',
			'KEY1_3' => 'VALUE1_3',
			'KEY1_4' => 'VALUE1_4',
		]);
		$this->assertEquals(Enum2::getEnums(), [
			'KEY2_1' => 'VALUE2_1',
			'KEY2_2' => 'VALUE2_2',
			'KEY2_3' => 'VALUE2_3',
			'KEY2_4' => 'VALUE2_4',
		]);
		$this->assertEquals(Enum3::getEnums(), [
			'KEY3_5' => 'VALUE3_5',
			'KEY1_1' => 'VALUE1_1',
			'KEY1_2' => 'VALUE1_2',
			'KEY1_3' => 'VALUE1_3',
			'KEY1_4' => 'VALUE1_4',
		]);
	}
	public function testGetKeys() {
		$this->assertEquals(Enum1::getKeys(), [
			'KEY1_1',
			'KEY1_2',
			'KEY1_3',
			'KEY1_4',
		]);
		$this->assertEquals(Enum2::getKeys(), [
			'KEY2_1',
			'KEY2_2',
			'KEY2_3',
			'KEY2_4',
		]);
		$this->assertEquals(Enum3::getKeys(), [
			'KEY3_5',
			'KEY1_1',
			'KEY1_2',
			'KEY1_3',
			'KEY1_4',
		]);
	}
	public function testGetValues() {
		$this->assertEquals(Enum1::getValues(), [
			'VALUE1_1',
			'VALUE1_2',
			'VALUE1_3',
			'VALUE1_4',
		]);
		$this->assertEquals(Enum2::getValues(), [
			'VALUE2_1',
			'VALUE2_2',
			'VALUE2_3',
			'VALUE2_4',
		]);
		$this->assertEquals(Enum3::getValues(), [
			'VALUE3_5',
			'VALUE1_1',
			'VALUE1_2',
			'VALUE1_3',
			'VALUE1_4',
		]);
	}
	
	public function testIsValid() {
		$this->assertTrue(Enum1::isValid('VALUE1_1'));
		$this->assertTrue(Enum1::isValid('VALUE1_2'));
		$this->assertTrue(Enum1::isValid('VALUE1_3'));
		$this->assertTrue(Enum1::isValid('VALUE1_4'));
		$this->assertFalse(Enum1::isValid('BAD'));

		$this->assertTrue(Enum2::isValid('VALUE2_1'));
		$this->assertTrue(Enum2::isValid('VALUE2_2'));
		$this->assertTrue(Enum2::isValid('VALUE2_3'));
		$this->assertTrue(Enum2::isValid('VALUE2_4'));
		$this->assertFalse(Enum2::isValid('BAD'));

		$this->assertTrue(Enum3::isValid('VALUE1_1'));
		$this->assertTrue(Enum3::isValid('VALUE1_2'));
		$this->assertTrue(Enum3::isValid('VALUE1_3'));
		$this->assertTrue(Enum3::isValid('VALUE1_4'));
		$this->assertTrue(Enum3::isValid('VALUE3_5'));
		$this->assertFalse(Enum3::isValid('BAD'));
	}

	public function testIsValidKey() {
		$this->assertTrue(Enum1::isValidKey('KEY1_1'));
		$this->assertTrue(Enum1::isValidKey('KEY1_2'));
		$this->assertTrue(Enum1::isValidKey('KEY1_3'));
		$this->assertTrue(Enum1::isValidKey('KEY1_4'));
		$this->assertFalse(Enum1::isValidKey('BAD'));

		$this->assertTrue(Enum2::isValidKey('KEY2_1'));
		$this->assertTrue(Enum2::isValidKey('KEY2_2'));
		$this->assertTrue(Enum2::isValidKey('KEY2_3'));
		$this->assertTrue(Enum2::isValidKey('KEY2_4'));
		$this->assertFalse(Enum2::isValidKey('BAD'));

		$this->assertTrue(Enum3::isValidKey('KEY1_1'));
		$this->assertTrue(Enum3::isValidKey('KEY1_2'));
		$this->assertTrue(Enum3::isValidKey('KEY1_3'));
		$this->assertTrue(Enum3::isValidKey('KEY1_4'));
		$this->assertTrue(Enum3::isValidKey('KEY3_5'));
		$this->assertFalse(Enum3::isValidKey('BAD'));
	}

	public function testSearch() {
		$this->assertEquals(Enum1::search('VALUE1_1'), 'KEY1_1');
		$this->assertEquals(Enum1::search('VALUE1_2'), 'KEY1_2');
		$this->assertEquals(Enum1::search('VALUE1_3'), 'KEY1_3');
		$this->assertEquals(Enum1::search('VALUE1_4'), 'KEY1_4');
		$this->assertNull(Enum1::search('BAD'));
		
		$this->assertEquals(Enum2::search('VALUE2_1'), 'KEY2_1');
		$this->assertEquals(Enum2::search('VALUE2_2'), 'KEY2_2');
		$this->assertEquals(Enum2::search('VALUE2_3'), 'KEY2_3');
		$this->assertEquals(Enum2::search('VALUE2_4'), 'KEY2_4');
		$this->assertNull(Enum1::search('BAD'));
		
		$this->assertEquals(Enum3::search('VALUE1_1'), 'KEY1_1');
		$this->assertEquals(Enum3::search('VALUE1_1'), 'KEY1_1');
		$this->assertEquals(Enum3::search('VALUE1_1'), 'KEY1_1');
		$this->assertEquals(Enum3::search('VALUE1_1'), 'KEY1_1');
		$this->assertEquals(Enum3::search('VALUE3_5'), 'KEY3_5');
		$this->assertNull(Enum1::search('BAD'));
	}

}