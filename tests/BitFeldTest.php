<?php declare(strict_types=1);

/**
 * Tests for BitField
 */
class BitFieldTest extends \PHPUnit\Framework\TestCase
{
    public function testBitSetGet(): void
    {
        $field = new _BitField();
        $this->assertEquals(0, $field->getValue());
        $field->setBit(_BitField::A);
        $this->assertTrue($field->getBit(_BitField::A));
        $this->assertFalse($field->getBit(_BitField::B));
    }

    public function testClear(): void
    {
        $field = new _BitField();
        $field->setBit(_BitField::A);
        $this->assertTrue($field->getBit(_BitField::A));
        $field->clearBit(_BitField::A);
        $this->assertFalse($field->getBit(_BitField::A));
    }
}

class _BitField extends \rash\basic\structures\BitField
{
    const A = 0x0001;
    const B = 0x0002;
}
