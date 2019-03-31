<?php declare(strict_types=1);

/**
 * Tests for Collection
 */
class CollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorWithData(): void
    {
        $collection = new _Collection([
            new _CollectionItem(new _CollectionItemId('a')),
            new _CollectionItem(new _CollectionItemId('b'))
        ]);
        $this->assertCount(2, $collection);
    }

    public function testTypeChecking(): void
    {
        $collection = new _Collection([
            new _CollectionItem(new _CollectionItemId('a'))
        ]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be of type _CollectionItem');
        $collection[] = uniqid();
    }

    public function testAdd(): void
    {
        $collection = new _Collection();
        $this->assertInstanceOf(_Collection::class, $collection->add(new _CollectionItem(new _CollectionItemId('a'))));
    }

    public function testAddMayAddSameObjectMultipleTimes(): void
    {
        $obj1 = new _CollectionItem(new _CollectionItemId('a'));
        $collection1 = new _Collection();
        $collection2 = new _Collection();
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
        $obj1 = new _CollectionItem(new _CollectionItemId('a'));
        $obj2 = new _CollectionItem(new _CollectionItemId('a'));
        $collection = new _Collection();
        $collection->add($obj1);
        $this->assertTrue($collection->contain($obj1));
        $this->assertFalse($collection->contain($obj2));
    }

    public function testContainsNonStrict(): void
    {
        $obj1 = new _CollectionItem(new _CollectionItemId('a'));
        $obj2 = new _CollectionItem(new _CollectionItemId('a'));
        $collection = new _Collection();
        $collection->add($obj1);
        $this->assertTrue($collection->contain($obj1, false));
        $this->assertTrue($collection->contain($obj2, false));
    }

    public function testRemove(): void
    {
        $obj1 = new _CollectionItem(new _CollectionItemId('a'));
        $collection = new _Collection();
        $collection->add($obj1);
        $this->assertTrue($collection->remove($obj1));
        $this->assertFalse($collection->remove($obj1));
    }
}

class _Collection extends \rash\basic\structures\ContainsIdCollection
{
    public function getType(): string
    {
        return _CollectionItem::class;
    }
}

class _CollectionItem implements \rash\basic\interfaces\ContainsIdInterface
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

class _CollectionItemId extends \rash\basic\structures\Id
{

}