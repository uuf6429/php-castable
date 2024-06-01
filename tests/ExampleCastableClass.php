<?php

namespace uuf6429\Castable;

use InvalidArgumentException;

class ExampleCastableClass implements Castable
{
    /**
     * @param string $type
     * @return int|string
     */
    public function castTo(string $type)
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
