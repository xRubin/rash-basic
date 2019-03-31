<?php declare(strict_types=1);

namespace rash\basic\structures;

use rash\basic\interfaces\EnumInterface;
use Webmozart\Assert\Assert;

abstract class Enum implements EnumInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param $value
     * @throws \ReflectionException
     */
    final public function __construct($value)
    {
        Assert::oneOf($value, self::getAllVariants());

        $this->value = $value;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getAllVariants(): array
    {
        $c = new \ReflectionClass(static::class);
        return $c->getConstants();
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
     * @throws \ReflectionException
     */
    public static function fromString(string $value)
    {
        return new static($value);
    }

    /**
     * @param EnumInterface $enum
     * @return bool
     */
    public function equalTo(EnumInterface $enum): bool
    {
        return $this->getValue() === $id->getValue();
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
