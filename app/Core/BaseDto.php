<?php

namespace App\Core;

abstract class BaseDto
{
    public static function get()
    {
        return new static();
    }
}