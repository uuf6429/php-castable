<?php

namespace uuf6429\Castable;

use InvalidArgumentException;

class ExampleCastableClass implements Castable
{
    public function castTo($type)
    {
        switch ($type) {
            case 'int':
                return 123;

            case 'string':
                return 'example';

            default:
                throw new InvalidArgumentException("Unsupported cast type: $type");
        }
    }
}