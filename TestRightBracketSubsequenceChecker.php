<?php

use App\RightBracketSubsequenceChecker;

class TestRightBracketSubsequenceChecker extends \PHPUnit\Framework\TestCase
{
    private RightBracketSubsequenceChecker $checker;

    public function setUp(): void
    {
        $this->checker = new RightBracketSubsequenceChecker;
    }

    public function positiveCasesDataProvider(): \Generator
    {
        yield ['{}{}{}{}{}{}'];
        yield ['[[]][][((())){}{}]'];
        yield ['[[]][]()()()'];
        yield ['{{{{}}}}(())[[]][][][]((((())))){}{}{}{[[]]}'];
        yield ['{{{{}}}}{{}}[[{}]][][][]((({}{([])}(())))){}{}{}{[[]]}'];
    }

    public function negativeCasesDataProvider(): \Generator
    {
        yield ['[[[]]](()()()()()())))(({}{}{{}}}}{{{{}}'];
        yield ['}}}{}{{}[[][{}]()))((()'];
        yield ['())(()()()()(){][[[[]}[[]))))((}}{}'];
        yield ['{)'];
        yield ['{{{((([[[{]]])))}}}'];
    }

    /**
     * @dataProvider positiveCasesDataProvider
     */
    public function testPositiveCasesCheck(string $subsequence): void
    {
        static::assertEquals(true, $this->checker->check($subsequence));
    }

    /**
     * @dataProvider negativeCasesDataProvider
     */
    public function testNegativeCasesCheck(string $subsequence): void
    {
        static::assertEquals(false, $this->checker->check($subsequence));
    }
}