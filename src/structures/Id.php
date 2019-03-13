<?php declare(strict_types=1);

namespace rash\basic\structures;

use rash\basic\interfaces\IdInterface;

abstract class Id implements IdInterface, \JsonSerializable
{
    /** @var string */
    private $value;

    /**
     * CharacterId constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return static
     */
    public static function fromString(string $value)
    {
            return new static($value);
    }

    /**
     * @param IdInterface $id
     * @return bool
     */
    public function equalTo(IdInterface $id): bool
    {
        return $this->getValue() === $id->getValue();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->getValue();
    }
}