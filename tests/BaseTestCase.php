<?php

namespace uuf6429\Castable;

if (class_exists(\PHPUnit\Framework\TestCase::class)) {
    class BaseTestCase extends \PHPUnit\Framework\TestCase
    {
    }
} elseif (class_exists(\PHPUnit_Framework_TestCase::class)) {
    class BaseTestCase extends \PHPUnit_Framework_TestCase
    {
    }
}
