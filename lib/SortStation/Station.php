<?php


namespace SortStation;


use Monad\Stack;

class Station
{
    public static function sort(string $formula): array
    {
        $lexems = new Stack();
        $lexems->apply([]);

        for ($i = 0; $i < strlen($formula); $i++) {
            $lexem = $formula[$i];
            if (
                is_numeric($lexem) ||
                $lexem == "(" ||
                $lexem == ")" ||
                $lexem == "+" ||
                $lexem == "-" ||
                $lexem == "*" ||
                $lexem == "/" ||
                $lexem == "."
            ) {
                $lexems->push($lexem);
            }
        }

        return $lexems->toArray();
    }
}