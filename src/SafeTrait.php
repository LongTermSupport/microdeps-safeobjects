<?php

declare(strict_types=1);

namespace MicroDeps\SafeObjects;

use RuntimeException;

trait SafeTrait
{
    /** @return never */
    public function __set(string $name, mixed $value): void
    {
        throw new RuntimeException(
            sprintf(
                SafeObjectInterface::SET_EXCEPTION_MSG,
                $name,
                $this->guessProperty($name)
            )
        );
    }

    /** @return never */
    public function __get(string $name): void
    {
        throw new RuntimeException(
            sprintf(
                SafeObjectInterface::EXCEPTION_MSG,
                'get',
                $name,
                $this->guessProperty($name)
            )
        );
    }

    /** @return never */
    public function __isset(string $name): bool
    {
        throw new RuntimeException(
            sprintf(
                SafeObjectInterface::EXCEPTION_MSG,
                'isset',
                $name,
                $this->guessProperty($name)
            )
        );
    }

    private function guessProperty(string $incorrectProperty): string
    {
        return (new PropertyGuesser($this, $incorrectProperty))->getGuess();
    }
}
