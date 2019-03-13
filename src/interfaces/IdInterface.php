<?php declare(strict_types=1);

namespace rash\basic\interfaces;

interface IdInterface
{
    /**
     * @param string $value
     * @return static
     */
    public static function fromString(string $value);

    /**
     * @param IdInterface $id
     * @return bool
     */
    public function equalTo(IdInterface $id): bool;

    /**
     * @return string
     */
    public function getValue(): string;
}