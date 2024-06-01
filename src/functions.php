<?php

namespace uuf6429\Castable;

use Throwable;

/**
 * @template T
 * @param mixed $value
 * @param class-string<T> $type
 * @return T
 */
function cast($value, string $type)
{
    static $basicTypes = ['bool', 'string', 'int', 'float', 'array', 'object', 'null'];
    static $typeAliases = ['boolean' => 'bool', 'integer' => 'int', 'double' => 'float'];
    $type = $typeAliases[$type] ?? $type;

    try {
        if (is_object($value) && is_a($value, $type)) {
            return $value;
        }

        if (gettype($value) === $type) {
            return $value;
        }

        if ($value instanceof Castable) {
            return $value->castTo($type);
        }

        if (in_array($type, $basicTypes, true)) {
            @settype($value, $type);
            return $value;
        }

        throw new NotCastableException(
            sprintf('Cannot cast %s to %s', is_object($value) ? get_class($value) : gettype($value), $type)
        );
    } catch (Throwable $ex) {
        throw new NotCastableException(
            sprintf(
                'Cannot cast %s to %s: %s',
                is_object($value) ? get_class($value) : gettype($value),
                $type,
                $ex->getMessage()
            ),
            0,
            $ex
        );
    }
}
