<?php
declare(strict_types=1);

/**
 * Tests for Collection
 */
class CollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorWithData(): void
    {
        $collection = new Collection([
            new CollectionItem(new CollectionItemId('a')),
            new CollectionItem(new CollectionItemId('b'))
        ]);
        $this->assertCount(2, $collection);
    }

    public function testTypeChecking(): void
    {
        $collection = new Collection([new CollectionItem(new CollectionItemId('a'))]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be of type CollectionItem');
        $collection[] = uniqid();
    }

    public function testAdd(): void
    {
        $collection = new Collection();
        $this->assertInstanceOf(Collection::class, $collection->add(new CollectionItem(new CollectionItemId('a'))));
    }

    public function testAddMayAddSameObjectMultipleTimes(): void
    {
        $obj1 = new CollectionItem(new CollectionItemId('a'));
        $collection1 = new Collection();
        $collection2 = new Collection();
        // Add the same object multiple times
        for ($i = 0; $i < 4; $i++) {
            $collection1[] = $obj1;
        }
        // Test the add() method
        for ($i = 0; $i < 4; $i++) {
            $collection2->add($obj1);
        }
        $this->assertCount(1, $collection1);
        $this->assertCount(1, $collection2);
    }

    public function testContains(): void
    {
        $obj1 = new CollectionItem(new CollectionItemId('a'));
        $obj2 = new CollectionItem(new CollectionItemId('a'));
        $collection = new Collection();
        $collection->add($obj1);
        $this->assertTrue($collection->contain($obj1));
        $this->assertFalse($collection->contain($obj2));
    }

    public function testContainsNonStrict(): void
    {
        $obj1 = new CollectionItem(new CollectionItemId('a'));
        $obj2 = new CollectionItem(new CollectionItemId('a'));
        $collection = new Collection();
        $collection->add($obj1);
        $this->assertTrue($collection->contain($obj1, false));
        $this->assertTrue($collection->contain($obj2, false));
    }

    public function testRemove(): void
    {
        $obj1 = new CollectionItem(new CollectionItemId('a'));
        $collection = new Collection();
        $collection->add($obj1);
        $this->assertTrue($collection->remove($obj1));
        $this->assertFalse($collection->remove($obj1));
    }
}

class Collection extends \rash\basic\structures\ContainsIdCollection
{
    public function getType(): string
    {
        return CollectionItem::class;
    }
}

class CollectionItem implements \rash\basic\interfaces\ContainsIdInterface
{
    /** @var \rash\basic\interfaces\IdInterface */
    private $id;

    /**
     * @param \rash\basic\interfaces\IdInterface $id
     */
    public function __construct(\rash\basic\interfaces\IdInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @return \rash\basic\interfaces\IdInterface
     */
    public function getId(): \rash\basic\interfaces\IdInterface
    {
        return $this->id;
    }
}

class CollectionItemId extends \rash\basic\structures\Id
{

}