# Comparator

[![Build Status](https://travis-ci.org/ottaviano/comparator.svg?branch=master)](https://travis-ci.org/ottaviano/comparator)

```php
<?php

$a = [
    'a' => 1,
    'c' => 5,
    'd' => [1,2],
    'f' => 10,
];

$b = [
    'f' => 10,
    'a' => 'test',
    'b' => 1,
    'd' => [5, 2 => 7],
    'e' => 'hello',
];

$comparator = new Comparator(new PlusMinusExporter());

dump($comparator->compare($a, $b));
```

```
array:6 [
  "[*]a" => "test"
  "[-]c" => 5
  "[*]d" => array:3 [
    "[*]0" => 5
    "[-]1" => 2
    "[+]2" => 7
  ]
  "[=]f" => 10
  "[+]b" => 1
  "[+]e" => "hello"
]
```
