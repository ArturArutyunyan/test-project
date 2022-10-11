<?php

namespace Dunice\RefactorTest;

$file = $argv && $argv[1] ? file_get_contents($argv[1]) : file_get_contents('input.txt');

$calculator = new Calculator();
$calculator->calculate($file);
