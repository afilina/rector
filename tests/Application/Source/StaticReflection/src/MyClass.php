<?php

final class MyClass extends ParentClass
{
    public function __construct()
    {
        throw new RuntimeException('Static reflection should not execute the code.');
    }
}

new MyClass();
