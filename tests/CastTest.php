<?php

namespace uuf6429\Castable;

use ArrayObject;

class CastTest extends BaseTestCase
{
    /**
     * @dataProvider invalidCastingDataProvider
     */
    public function test_that_invalid_casting_triggers_exception($originalValue, $targetType)
    {
        $this->expectException(NotCastableException::class);

        cast($originalValue, $targetType);
    }

    public function invalidCastingDataProvider()
    {
        return [
            'invalid data type of target type' => [
                '$originalValue' => 1,
                '$targetType' => 1,
            ],
            'invalid target type' => [
                '$originalValue' => 1,
                '$targetType' => 'invalid',
            ],
            'invalid conversion; object to integer' => [
                '$originalValue' => (object)[],
                '$targetType' => 'integer',
            ],
            'invalid conversion; object to specific class' => [
                '$originalValue' => (object)[],
                '$targetType' => ArrayObject::class,
            ],
            'converting example object unsupported type' => [
                '$originalValue' => new ExampleCastableClass(),
                '$targetType' => 'someType',
            ],
            'as per php, aliases should not work' => [
                '$originalValue' => new ExampleCastableClass(),
                '$targetType' => 'integer',
            ],
        ];
    }

    /**
     * @dataProvider validCastingDataProvider
     */
    public function test_that_valid_casting_returns_expected_value($originalValue, $targetType, $expectedValue)
    {
        $this->assertSame($expectedValue, cast($originalValue, $targetType));
    }

    public function validCastingDataProvider()
    {
        return [
            'converting number to string' => [
                '$originalValue' => 123,
                '$targetType' => 'string',
                '$expectedValue' => '123',
            ],
            'converting number to boolean' => [
                '$originalValue' => 1,
                '$targetType' => 'bool',
                '$expectedValue' => true,
            ],
            'converting float to integer (lossy)' => [
                '$originalValue' => 123.456,
                '$targetType' => 'int',
                '$expectedValue' => 123,
            ],
            'converting specific object to generic object' => [
                '$originalValue' => ($inst = new ArrayObject()),
                '$targetType' => 'object',
                '$expectedValue' => $inst,
            ],
            'converting example object to number should work' => [
                '$originalValue' => new ExampleCastableClass(),
                '$targetType' => 'int',
                '$expectedValue' => 123,
            ],
        ];
    }
}
