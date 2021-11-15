<?php

declare(strict_types=1);

namespace MicroDeps\SafeObjects\Tests;

use Generator;
use MicroDeps\SafeObjects\PropertyGuesser;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @covers \MicroDeps\SafeObjects\PropertyGuesser
 *
 * @small
 */
final class PropertyGuesserTest extends TestCase
{
    private const SUGGEST_ALL = 'one of 
  - foo
  - thing';

    private function getTestObject(): object
    {
        return new class() {
            public string  $foo;
            public string  $thing;
            /* @phpstan-ignore-next-line */
            private string $bar;
        };
    }

    /** @test */
    public function itReturnsAllForLongPropertyNames(): void
    {
        $actual   = $this->getGuess(str_repeat('a', 256));
        $expected = self::SUGGEST_ALL;
        self::assertSame($expected, $actual);
    }

    private function getGuess(string $name): string
    {
        return (new PropertyGuesser($this->getTestObject(), $name))
            ->getGuess();
    }

    /** @test */
    public function itReturnsAllForTotallyWrongNames(): void
    {
        $actual   = $this->getGuess('bar');
        $expected = self::SUGGEST_ALL;
        self::assertSame($expected, $actual);
    }

    /**
     * @return Generator<string, array{string, string}>
     */
    public function provideTypos(): Generator
    {
        yield 'fo' => ['fo', 'foo'];
        yield 'of' => ['of', 'foo'];
        yield 'fooo' => ['fooo', 'foo'];
    }

    /**
     * @test
     * @dataProvider provideTypos
     */
    public function itReturnsSpecificPropertyIfTypo(string $typo, string $expected): void
    {
        $actual = $this->getGuess($typo);
        self::assertSame($expected, $actual);
    }
}
