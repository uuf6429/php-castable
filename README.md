# 🎭 PHP Castable

[![CI](https://github.com/uuf6429/php-castable/actions/workflows/ci.yml/badge.svg)](https://github.com/uuf6429/php-castable/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/uuf6429/php-castable/branch/main/graph/badge.svg)](https://codecov.io/gh/uuf6429/php-castable)
[![Minimum PHP Version](https://img.shields.io/badge/php-%5E5.6%20%7C%20%5E7%20%7C%20%5E8-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/uuf6429/php-castable/license)](https://packagist.org/packages/uuf6429/php-castable)
[![Latest Stable Version](https://poser.pugx.org/uuf6429/php-castable/version)](https://packagist.org/packages/uuf6429/php-castable)
[![Latest Unstable Version](https://poser.pugx.org/uuf6429/php-castable/v/unstable)](https://packagist.org/packages/uuf6429/php-castable)

Basic groundwork for type-casting in PHP.

## 🔌 Installation
The recommended and easiest way to install this library is through Composer:

```shell
composer require uuf6429/php-castable "^1.0"
```

## ⭐️ Features / Functionality

- Works with simple types and objects
- `cast($value, $type)` function that converts a value to a target type.
- `Castable` interface, exposes method that is called whenever `cast()` is called on objects implementing this interface.
- Error handling - all errors routed to `NotCastableException`
- Fixes type-hinting for PhpStorm
- PHP 5.6+ (but seriously, stop using PHP 5 :))

While `cast()` is just a regular PHP function, it would be the equivalent to type-casting operators in other languages (e.g. `val as Type`, `(Type)val`, `val.to(Type)`, `CAST(val, TYPE)`...).

## 🚀 Example

```php
class Cat implements \uuf6429\Castable\Castable
{
    public function castTo($type)
    {
        if ($type === Dog::class) {
            return new Dog();
        }

        throw new RuntimeException("Unsupported type $type.");
    }
}

class Dog {}

$dog = \uuf6429\Castable\cast(new Cat(), Dog::class); // ok, cat becomes a dog :)
$cat = \uuf6429\Castable\cast($dog, Cat::class);      // not allowed
```

## 🔍 Casting Behaviour

The casting process follows these steps:
1. If the value to be type-casted is not an object, PHP's `settype()` is used.
2. If, instead, it is an object that implements `Castable` interface, `castTo()` is called and its value returned.
3. Otherwise, if the object is the same or a subclass of the desired type, then it is returned unchanged.

At any point in time, errors or unsupported type-casting could occur, in which case a `NotCastableException` is thrown.

## 💰 Motivation

In many cases, having specific `castToX()` methods in your classes is enough, and it typically works adequately.

However, this could get very repetitive and somewhat error-prone, until a more dynamic solution is needed. This package helps to safely avoid all that boilerplate code.