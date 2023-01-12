<?php

declare(strict_types=1);

namespace App;

class RightBracketSubsequenceChecker extends \SplStack
{
    private const ASSOC = [
        '[' => ']',
        '{' => '}',
        '(' => ')'
    ];

    public function check(string $subsequence): bool
    {
        // -- -- Количество элементов должно быть четное
        if (strlen($subsequence) % 2 !== 0) {
            return false;
        }
        // -- -- -- --

        $brackets = str_split($subsequence);
        foreach ($brackets as $key => $bracket) {
            if ($this->isEmpty() && in_array($bracket, self::ASSOC)) {
                return false;
            }

            if (array_key_exists($bracket, self::ASSOC)) {
                $this->push($bracket);
                unset($brackets[$key]);

                continue;
            }

            $opened = $this->pop();
            if ($bracket !== self::ASSOC[$opened]) {
                return false;
            }

            unset($brackets[$key]);
        }

        if ($this->count() !== 0 || count($brackets) !== 0) {
            return false;
        }

        return true;
    }
}
