<?php

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/app/' . $class_name . '.php';
});