<?php declare(strict_types=1);

namespace Best\Maybe\Test;

use Best\Maybe\MaybeString;

class TestAll extends \PHPUnit\Framework\TestCase
{
    public function testMaybeStringWithArray()
    {
        $array = [
            'non-null' => 'non-null value',
            'null' => null,
        ];

        $nonNull = MaybeString::fromArrayAndStringKey($array, 'non-null');
        $null = MaybeString::fromArrayAndStringKey($array, 'null');
        $nonExistent = MaybeString::fromArrayAndStringKey($array, 'non-existent');

        $this->assertSame(true, $nonNull->isPresentAndNotNull());
        $this->assertSame(false, $nonNull->isMissing());
        $this->assertSame(false, $nonNull->isMissingOrNull());
        $this->assertSame('non-null value', $nonNull->getValue());
        $this->assertSame('non-null value', $nonNull->getValueOrNull());

        $this->assertSame(false, $null->isPresentAndNotNull());
        $this->assertSame(false, $null->isMissing());
        $this->assertSame(true, $null->isMissingOrNull());
        $this->assertSame(null, $null->getValueOrNull());

        $this->assertSame(false, $nonExistent->isPresentAndNotNull());
        $this->assertSame(true, $nonExistent->isMissing());
        $this->assertSame(true, $nonExistent->isMissingOrNull());
        $this->assertSame(null, $nonExistent->getValueOrNull());
    }

    public function testMaybeStringWithObject()
    {
        $object = new \stdClass;
        $object->nonNull = 'non-null value';
        $object->null = null;

        $nonNull = MaybeString::fromObjectAndProperty($object, 'nonNull');
        $null = MaybeString::fromObjectAndProperty($object, 'null');
        $nonExistent = MaybeString::fromObjectAndProperty($object, 'non-existent');

        $this->assertSame(true, $nonNull->isPresentAndNotNull());
        $this->assertSame(false, $nonNull->isMissing());
        $this->assertSame(false, $nonNull->isMissingOrNull());
        $this->assertSame('non-null value', $nonNull->getValue());
        $this->assertSame('non-null value', $nonNull->getValueOrNull());

        $this->assertSame(false, $null->isPresentAndNotNull());
        $this->assertSame(false, $null->isMissing());
        $this->assertSame(true, $null->isMissingOrNull());
        $this->assertSame(null, $null->getValueOrNull());

        $this->assertSame(false, $nonExistent->isPresentAndNotNull());
        $this->assertSame(true, $nonExistent->isMissing());
        $this->assertSame(true, $nonExistent->isMissingOrNull());
        $this->assertSame(null, $nonExistent->getValueOrNull());
    }

    public function testMaybeStringThrowsExceptionWhenGettingValueOfMissing()
    {
    }

    public function testMaybeStringThrowsExceptionWhenGettingValueOfNull()
    {

    }

}