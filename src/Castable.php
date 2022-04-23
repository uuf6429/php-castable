<?php

namespace uuf6429\Castable;

interface Castable
{
    /**
     * @param string $type
     * @return mixed
     */
    public function castTo($type);
}
