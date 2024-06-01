<?php

namespace uuf6429\Castable;

interface Castable
{
    /**
     * @template T
     * @param class-string<T> $type
     * @return T
     */
    public function castTo(string $type);
}
