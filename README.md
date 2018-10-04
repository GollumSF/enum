# Enum

Simple classe, trait and interface for implement enum in PHP 

## Installation:

```shell
composer require gollumsf/enum
```

## Usage:

### Basic:

```php
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

var_dump(MyEnum::getLabels());
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
```

### Without extends or extends other class:

```php

namespace App\MyNamespace;

use GollumSF\Enum\EnumInterface;
use GollumSF\Enum\EnumTrait;

class MyEnum implements EnumInterface {
	
	use EnumTrait;
	
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}
```

### Add translate key on enum value:


```php
namespace App\MyNamespace;

class MyEnum extends TranslatedEnum {
	
	
	CONST KEY_1 = 'value1';
	CONST KEY_2 = 'value2';
	CONST KEY_3 = 'value3';
	CONST KEY_4 = 'value4';
}

var_dump(MyEnum::getTranslatedKeysValue());
// array(4) {
//   ["KEY_1"]=> string(22) "app.my_namespace.key_1"
//   ["KEY_2"]=> string(22) "app.my_namespace.key_2"
//   ["KEY_3"]=> string(22) "app.my_namespace.key_3"
//   ["KEY_4"]=> string(22) "app.my_namespace.key_4"
// }
```