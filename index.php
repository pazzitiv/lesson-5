<?php
require __DIR__ . '/vendor/autoload.php';


use Monad\Monad;
use \Monad\Stack;
use Notations\Polish;
use SortStation\Station;

$getString = function (string $item) {
    $input = $item . fgets(STDIN);
    return $input;
};

$IO = new Monad();
$formula = $IO->apply('')
    ->map($getString);

$Calc = new Monad();
$result = $Calc->apply((string)$formula)
    ->map(fn($item) => eval("return {$item};"));

$Polish = (clone $formula)
    ->map(fn($item) => Station::sort($item))
    ->map(fn($item) => Polish::notation($item));

echo "Formula: {$formula}";
echo "Polish: {$Polish} = {$result}\n";