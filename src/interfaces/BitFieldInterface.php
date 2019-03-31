<?php declare(strict_types=1);

namespace rash\basic\interfaces;

interface BitFieldInterface
{
    /**
     * @param int $value
     * @return static
     */
    public static function fromString(int $value);

    /**
     * @param int $n
     * @return bool
     */
    public function getBit(int $n): bool;

    /**
     * @param int $n
     */
    public function setBit(int $n);

    /**
     * @param int $n
     */
    public function clearBit(int $n);

    /**
     * @return int
     */
    public function getValue(): int;
}