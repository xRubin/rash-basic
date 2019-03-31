<?php declare(strict_types=1);

/**
 * Tests for Enum
 */
class EnumTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        $enum = new _Enum(_Enum::A);
        $this->assertEquals('A', (string)$enum);
    }

    public function testTypeChecking(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected one of: "A", "B". Got: "C"');
        $enum = new _Enum('C');
    }
}

class _Enum extends \rash\basic\structures\Enum
{
    const A = 'A';
    const B = 'B';
}
