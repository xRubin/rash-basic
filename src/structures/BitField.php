<?php declare(strict_types=1);

namespace rash\basic\structures;

use rash\basic\interfaces\BitFieldInterface;

abstract class BitField implements BitFieldInterface
{
    /** @var int */
    private $value;

    /**
     * BitField constructor.
     * @param int $value
     */
    public function __construct($value = 0)
    {
        $this->value = $value;
    }

    /**
     * @param int $n
     * @return bool
     */
    public function getBit(int $n): bool
    {
        return ($this->value & $n) == $n;
    }

    /**
     * @param int $n
     */
    public function setBit(int $n)
    {
        $this->value |= $n;
    }

    /**
     * @param int $n
     */
    public function clearBit(int $n)
    {
        $this->value &= ~$n;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return static
     */
    public static function fromString(int $value)
    {
        return new static($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->getValue();
    }
}