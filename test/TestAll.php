<?php declare(strict_types=1);

namespace Best\Maybe\Test;

use Best\Maybe\MaybeString;

class TestAll extends \PHPUnit\Framework\TestCase
{
    public function testNonExistentOrNullableString()
    {
        $foo = [
            'non-null' => 'non-null value',
            'null' => null,
        ];

        $nonNull = MaybeString::fromArrayAndStringKey($foo, 'non-null');
        $null = MaybeString::fromArrayAndStringKey($foo, 'null');
        $nonExistent = MaybeString::fromArrayAndStringKey($foo, 'non-existent');

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

//    public function testNonExistentOrNullableStringThrowsExceptionWhenGettingValueOfNonExistent()
//    {
//    }
//
//    public function testNonExistentOrNullableStringThrowsExceptionWhenGettingValueOfNull()
//    {
//
//    }

}