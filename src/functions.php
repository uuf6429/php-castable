<?php

use uuf6429\Castable\Castable;
use uuf6429\Castable\NotCastableException;

function cast($value, $type)
{
    if (!is_object($value)) {
        if (settype($value, $type)) {
            return $value;
        }
        throw new NotCastableException(
            sprintf('Value of type %s cannot be cast to %s', gettype($value), $type)
        );
    }

    if ($value instanceof Castable) {
        try {
            return $value->castTo($type);
        } catch (Exception $exception) {
        } catch (Throwable $exception) {
        }
        throw new NotCastableException(
            sprintf('Castable object could not be cast to %s', $type), 0, $exception
        );
    }

    if (!is_a($value, $type)) {
        throw new NotCastableException(
            sprintf('Object of class %s is not compatible with class %s', get_class($value), $type)
        );
    }

    return $value;
}
