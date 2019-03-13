<?php declare(strict_types=1);

namespace rash\basic\structures;

use Ramsey\Collection\AbstractArray;
use Ramsey\Collection\Tool\TypeTrait;
use Ramsey\Collection\Tool\ValueToStringTrait;
use rash\basic\interfaces\ContainsIdCollectionInterface;
use rash\basic\interfaces\ContainsIdInterface;

abstract class ContainsIdCollection extends AbstractArray implements ContainsIdCollectionInterface
{
    use TypeTrait;
    use ValueToStringTrait;

    /**
     * @param ContainsIdInterface[] $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $value)
            $this->add($value);
    }

    /**
     * @return string
     */
    abstract public function getType():string;

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->data;
    }

    /**
     * @param ContainsIdInterface $element
     * @return ContainsIdCollectionInterface
     */
    public function add(ContainsIdInterface $element): ContainsIdCollectionInterface
    {
        $this[(string)$element->getId()] = $element;

        return $this;
    }

    /**
     * @param mixed $element
     * @param bool $strict
     * @return bool
     */
    public function contain(ContainsIdInterface $element, $strict = true):bool
    {
        return in_array($element, $this->data, $strict);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($this->getType(), $value) === false) {
            throw new \InvalidArgumentException(
                'Value must be of type ' . $this->getType() . '; value is '
                . $this->toolValueToString($value)
            );
        }

        $this->data[$offset] = $value;
    }

    /**
     * @param ContainsIdInterface $element
     * @return bool
     */
    public function remove(ContainsIdInterface $element)
    {
        if (($key = array_search($element, $this->data, true)) !== false) {
            $this->offsetUnset($key);
            return true;
        }

        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function removeKey(string $key)
    {
        if ($this->offsetExists($key)) {
            $this->offsetUnset($key);
            return true;
        }

        return false;
    }

    /**
     * @param callable $callback
     * @return static
     */
    public function filter(callable $callback): ContainsIdCollectionInterface
    {
        return new static(array_filter($this->toArray(), $callback));
    }
}
