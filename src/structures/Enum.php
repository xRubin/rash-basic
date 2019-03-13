<?php declare(strict_types=1);

namespace rash\basic\structures;

use Webmozart\Assert\Assert;

abstract class Enum implements \JsonSerializable
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
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->value;
    }
}
