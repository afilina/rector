<?php

final class MyClass
{
    public function __construct()
    {
        throw new RuntimeException('Static reflection should not execute the code.');
    }
}

new MyClass();
