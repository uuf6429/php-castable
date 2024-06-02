<?php

namespace uuf6429\Castable;

class ExampleCastableClass implements Castable
{
    public function castTo(string $type): int|string
    {
        /** @noinspection PhpSwitchCanBeReplacedWithMatchExpressionInspection */
        switch ($type) {
            case 'int':
                return 123;

            case 'string':
                return 'example';

            default:
                throw new NotCastableException("Unsupported cast type: $type");
        }
    }
}
