<?php declare(strict_types=1);

namespace rash\basic\interfaces;

use Ramsey\Collection\ArrayInterface;

interface ContainsIdCollectionInterface extends ArrayInterface
{
    /**
     * @param ContainsIdInterface $element
     * @return ContainsIdCollectionInterface
     */
    public function add(ContainsIdInterface $element): ContainsIdCollectionInterface;

    /**
     * @param mixed $element
     * @param bool $strict
     * @return bool
     */
    public function contain(ContainsIdInterface $element, $strict = true);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param mixed $element
     * @return bool
     */
    public function remove(ContainsIdInterface $element);

    /**
     * @param string $key
     * @return bool
     */
    public function removeKey(string $key);

    /**
     * @param callable $callback
     * @return static
     */
    public function filter(callable $callback): ContainsIdCollectionInterface;
}
