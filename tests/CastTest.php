<?php

namespace uuf6429\Castable;

use ArrayObject;
use PHPUnit\Framework\TestCase;

class CastTest extends TestCase
{
    /**
     * @dataProvider invalidCastingDataProvider
     * @param mixed $originalValue
     * @param class-string $targetType
     */
    public function test_that_invalid_casting_triggers_exception($originalValue, string $targetType): void
    {
        $this->expectException(NotCastableException::class);

        cast($originalValue, $targetType);
    }

    /**
     * @return iterable<string, array{originalValue: mixed, targetType: string}>
     */
    public static function invalidCastingDataProvider(): iterable
    {
        yield 'invalid target type' => [
            'originalValue' => 1,
            'targetType' => 'invalid',
        ];

        yield 'invalid conversion; object to string' => [
            'originalValue' => (object)[],
            'targetType' => 'string',
        ];

        yield 'invalid conversion; object to specific class' => [
            'originalValue' => (object)[],
            'targetType' => ArrayObject::class,
        ];

        yield 'converting example object unsupported type' => [
            'originalValue' => new ExampleCastableClass(),
            'targetType' => 'someType',
        ];
    }

    /**
     * @dataProvider validCastingDataProvider
     * @param mixed $originalValue
     * @param class-string $targetType
     * @param mixed $expectedValue
     */
    public function test_that_valid_casting_returns_expected_value($originalValue, string $targetType, $expectedValue): void
    {
        $this->assertSame($expectedValue, cast($originalValue, $targetType));
    }

    /**
     * @return iterable<string, array{originalValue: mixed, targetType: string, expectedValue: mixed}>
     */
    public static function validCastingDataProvider(): iterable
    {
        yield 'converting number to string' => [
            'originalValue' => 123,
            'targetType' => 'string',
            'expectedValue' => '123',
        ];

        yield 'converting number to boolean' => [
            'originalValue' => 1,
            'targetType' => 'bool',
            'expectedValue' => true,
        ];

        yield 'converting float to integer (lossy)' => [
            'originalValue' => 123.456,
            'targetType' => 'int',
            'expectedValue' => 123,
        ];

        yield 'converting specific object to generic object' => [
            'originalValue' => ($inst = new ArrayObject()),
            'targetType' => 'object',
            'expectedValue' => $inst,
        ];

        yield 'converting example object to number should work' => [
            'originalValue' => new ExampleCastableClass(),
            'targetType' => 'int',
            'expectedValue' => 123,
        ];

        yield 'example object to example object should be unchanged' => [
            'originalValue' => $orig = new ExampleCastableClass(),
            'targetType' => ExampleCastableClass::class,
            'expectedValue' => $orig,
        ];
    }
}
