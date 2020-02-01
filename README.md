# Enum
[![Build Status](https://travis-ci.com/GollumSF/enum.svg?branch=master)](https://travis-ci.com/GollumSF/enum)
[![Coverage](https://coveralls.io/repos/github/GollumSF/enum/badge.svg?branch=master)](https://coveralls.io/github/GollumSF/enum)
[![License](https://poser.pugx.org/gollumsf/enum/license)](https://packagist.org/packages/gollumsf/enum)
[![Latest Stable Version](https://poser.pugx.org/gollumsf/enum/v/stable)](https://packagist.org/packages/gollumsf/enum)
[![Latest Unstable Version](https://poser.pugx.org/gollumsf/enum/v/unstable)](https://packagist.org/packages/gollumsf/enum)
[![Discord](https://img.shields.io/discord/671741944149573687?color=purple&label=discord)](https://discord.gg/xMBc5SQ)


Simple classe, trait and interface for implement enum in PHP 

## Installation:

```shell
composer require gollumsf/enum
```

## Usages:

### Basic:

```php
<?php
namespace App\MyNamespace;

use GollumSF\Enum\Enum;

class MyEnum extends Enum {
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}

var_dump(MyEnum::getEnums());
// array(4) {
//   ["KEY_1"]=> string(6) "value1"
//   ["KEY_2"]=> string(6) "value2"
//   ["KEY_3"]=> string(6) "value3"
//   ["KEY_4"]=> string(6) "value4"
// }

var_dump(MyEnum::getKey());
// array(4) {
//   [0]=> string(4) "KEY_1"
//   [1]=> string(4) "KEY_2"
//   [2]=> string(4) "KEY_3"
//   [3]=> string(4) "KEY_4"
// }

var_dump(MyEnum::getValues());
// array(4) {
//   [0]=> string(6) "value1"
//   [1]=> string(6) "value2"
//   [2]=> string(6) "value3"
//   [3]=> string(6) "value4"
// }

var_dump(MyEnum::isValid('NO_VALUE'));
// bool(false)
var_dump(MyEnum::isValid(MyEnum::KEY_1));
// bool(true)

var_dump(MyEnum::isValidKey('NO_KEY'));
// bool(false)
var_dump(MyEnum::isValidKey('KEY_1'));
// bool(true)

var_dump(MyEnum::search('value1'));
// string(5) "KEY_1"
var_dump(MyEnum::search('NO_VALUE'));
// NULL

```

### Add translate key on enum value:


```php
<?php
namespace App\MyNamespace;

use GollumSF\Enum\TranslatedEnum;

class MyEnum extends TranslatedEnum {
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}

var_dump(MyEnum::getTranslatedEnums());
// array(4) {
//   ["KEY_1"]=> string(22) "app.my_namespace.key_1"
//   ["KEY_2"]=> string(22) "app.my_namespace.key_2"
//   ["KEY_3"]=> string(22) "app.my_namespace.key_3"
//   ["KEY_4"]=> string(22) "app.my_namespace.key_4"
// }

var_dump(MyEnum::getTranslatedValue());
// array(4) {
//   [0] => string(22) "app.my_namespace.key_1"
//   [1] => string(22) "app.my_namespace.key_2"
//   [2] => string(22) "app.my_namespace.key_3"
//   [3] => string(22) "app.my_namespace.key_4"
// }


var_dump(MyEnum::isTranslatedValid('NO_VALUE'));
// bool(false)
var_dump(MyEnum::isTranslatedValid('app.my_namespace.key_1'));
// bool(true)


var_dump(MyEnum::translatedSearch('app.my_namespace.key_1'));
// string(5) "KEY_1"
var_dump(MyEnum::translatedSearch('NO_VALUE'));
// NULL

```

### Without extends or extends other class:

```php
<?php
namespace App\MyNamespace;

use GollumSF\Enum\EnumInterface;
use GollumSF\Enum\EnumTrait;
use GollumSF\Enum\TranslatedEnumInterface;
use GollumSF\Enum\TranslatedEnumTrait;

class MyEnum extends OtherClass implements EnumInterface {
	
	use EnumTrait;
	
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}

class MyTranslatedEnum extends OtherClass implements TranslatedEnumInterface {
	
	use TranslatedEnumTrait;
	
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}
```

### Custom translated callback

```php
<?php
namespace App\MyNamespace;

use GollumSF\Enum\TranslatedEnum;

class MyEnum extends TranslatedEnum {
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}

TranslatedEnum::setCallbackTranslatedValue(function ($className, $key, $value) {
    return $className.'.'.$key.'.'.$value;
});

var_dump(MyEnum::getTranslatedEnums());
// array(4) {
//   ["KEY_1"]=> string(35) "App\MyNamespace\MyEnum.KEY_1.value1"
//   ["KEY_2"]=> string(35) "App\MyNamespace\MyEnum.KEY_2.value2"
//   ["KEY_3"]=> string(35) "App\MyNamespace\MyEnum.KEY_3.value3"
//   ["KEY_4"]=> string(35) "App\MyNamespace\MyEnum.KEY_4.value4"
// }
```
