<?php declare(strict_types=1);

namespace rash\basic\interfaces;

interface EnumInterface extends \JsonSerializable
{
    /**
     * @param string $value
     * @return static
     */
    public static function fromString(string $value);

    /**
     * @param EnumInterface $enum
     * @return bool
     */
    public function equalTo(EnumInterface $enum): bool;

    /**
     * @return string
     */
    public function getValue(): string;
}