# PHP Castable

Basic groundwork for type-casting in PHP.

## Features / Functionality

- Works with simple types and objects
- `cast($value, $type)` function that converts a value to a target type.
- `Castable` interface, exposes function called whenever cast() is called on objects implementing this interface.
- Error handling - all errors routed to `NotCastableException`
- Fixes type-hinting for PhpStorm
- PHP 5.6+ (but seriously, stop using PHP 5 :))

While `cast()` is just a regular PHP function, it would be the equivalent to type-casting operators in other languages (e.g. `val as Type`, `(Type)val`, `val.to(Type)`, `CAST(val, TYPE)`...).

## Behaviour

1. If the value to be type-casted is not an object, PHP's `settype()` is used.
2. If, instead, it is an object that implements `Castable` interface, `castTo()` is called and its value returned.
3. Otherwise, if the object is the same or a subclass of the desired type, then it is returned unchanged.

## Motivation

In many cases, having specific `castToX()` methods in your classes is enough and the behaviour typically works adequately.
However, sometimes this becomes too much or a more dynamic solution is needed. In this case, this package helps to avoid writing the boilerplate code.