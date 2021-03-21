<?php


namespace Notations;


use Monad\Stack;

class Polish
{
    public static function notation(array $lexems): string
    {
        $result = '';
        $stack = new Stack();
        $stack->apply([]);

        foreach ($lexems as $lexem) {
            switch ($lexem) {
                case ".":
                case is_numeric($lexem):
                    $result .= $lexem;
                    break;
                case '(':
                case '-':
                case '+':
                case '*':
                case '/':
                    while ($stack->len() !== 0 && array_search('*', $stack->toArray()) && array_search('/', $stack->toArray())) {
                        $stack = $stack->pop();
                        $result .= $stack->poped;
                    }
                    $stack->push($lexem);
                    break;
                case ')':
                    $stackArr = fn($stackObj) => $stackObj->toArray();
                    while ($stack->len() !== 0 && $stackArr($stack)[$stack->len() - 1] != '(') {
                        $stack = $stack->pop();
                        $result .= $stack->poped;
                    }
                    $stack->pop();
                    break;
            }
        }

        while ($stack->len() !== 0) {
            $stack = $stack->pop();
            $result .= $stack->poped;
        }

        return $result;
    }
}