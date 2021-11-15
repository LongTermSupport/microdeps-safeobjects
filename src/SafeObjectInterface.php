<?php

declare(strict_types=1);

namespace MicroDeps\SafeObjects;

interface SafeObjectInterface
{
    public const SET_EXCEPTION_MSG = 'Can not set dynamic property %s, did you mean %s';
    public const EXCEPTION_MSG     = 'Can not %s incorrect property %s, did you mean %s';

    /** @return never */
    public function __set(string $name, mixed $value): void;

    /** @return never */
    public function __get(string $name): void;

    /** @return never */
    public function __isset(string $name): bool;
}
