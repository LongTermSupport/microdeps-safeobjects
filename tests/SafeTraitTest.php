<?php

declare(strict_types=1);

namespace MicroDeps\SafeObjects\Tests;

use MicroDeps\SafeObjects\SafeObjectInterface;
use MicroDeps\SafeObjects\SafeTrait;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @internal
 * @covers \MicroDeps\SafeObjects\SafeTrait
 *
 * @small
 */
final class SafeTraitTest extends TestCase
{
    /** @test */
    public function itThrowsOnInvalidSet(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                SafeObjectInterface::SET_EXCEPTION_MSG,
                'foo',
                'one of 
  - realProperty
  - thing'
            )
        );
        /* @phpstan-ignore-next-line */
        $this->getTestObject()->foo = 'bar';
    }

    /** @test */
    public function itThrowsOnInvalidSetWithTypoSuggestion(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                SafeObjectInterface::SET_EXCEPTION_MSG,
                'tihng',
                'thing'
            )
        );
        /* @phpstan-ignore-next-line */
        $this->getTestObject()->tihng = 'bar';
    }

    /** @test */
    public function itThrowsOnInvalidGetWithTypoSuggestion(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                SafeObjectInterface::EXCEPTION_MSG,
                'get',
                'tihng',
                'thing'
            )
        );
        /* @phpstan-ignore-next-line */
        $this->getTestObject()->tihng;
    }

    /** @test */
    public function itThrowsOnInvalidIssetWithTypoSuggestion(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                SafeObjectInterface::EXCEPTION_MSG,
                'isset',
                'tihng',
                'thing'
            )
        );
        /* @phpstan-ignore-next-line */
        isset($this->getTestObject()->tihng);
    }

    private function getTestObject(): object
    {
        return new class() {
            public string $realProperty;
            public string $thing;
            use SafeTrait;
        };
    }
}
