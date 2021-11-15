<?php

declare(strict_types=1);

namespace MicroDeps\SafeObjects;

use ReflectionClass;
use ReflectionProperty;

final class PropertyGuesser
{
    private string $guess;

    public function __construct(object $class, string $incorrectProperty)
    {
        $this->guess = $this->guessCorrectProperty($class, $incorrectProperty);
    }

    public function getGuess(): string
    {
        return $this->guess;
    }

    private function guessCorrectProperty(object $class, string $incorrectProperty): string
    {
        $reflectionProperties = (new ReflectionClass($class))->getProperties(ReflectionProperty::IS_PUBLIC);
        $allPublicProps = [];
        foreach ($reflectionProperties as $reflectionProperty) {
            $allPublicProps[] = $reflectionProperty->name;
            $leven = levenshtein($incorrectProperty, $reflectionProperty->name);
            if (-1 === $leven) {
                continue;
            }
            if ($leven < 3) {
                return $reflectionProperty->name;
            }
        }

        return 'one of ' . "\n  - " . implode("\n  - ", $allPublicProps);
    }
}
