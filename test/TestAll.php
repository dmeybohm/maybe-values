<?php declare(strict_types=1);

namespace Best\NonExistentOrNullable\Test;

use Best\NonExistentOrNullable\NonExistentOrNullableString;

class TestAll extends \PHPUnit\Framework\TestCase
{
    public function testNonExistentOrNullableString()
    {
        $foo = [
            'non-null' => 'non-null value',
            'null' => null,
        ];

        $nonNull = NonExistentOrNullableString::fromArrayAndStringKey($foo, 'non-null');
        $null = NonExistentOrNullableString::fromArrayAndStringKey($foo, 'null');
        $nonExistent = NonExistentOrNullableString::fromArrayAndStringKey($foo, 'non-existent');

        $this->assertSame(true, $nonNull->isExistentAndNotNull());
        $this->assertSame(false, $nonNull->isNonExistent());
        $this->assertSame(false, $nonNull->isNonExistentOrNull());
        $this->assertSame('non-null value', $nonNull->getValue());
        $this->assertSame('non-null value', $nonNull->getValueOrNull());

        $this->assertSame(false, $null->isExistentAndNotNull());
        $this->assertSame(false, $null->isNonExistent());
        $this->assertSame(true, $null->isNonExistentOrNull());
        $this->assertSame(null, $null->getValueOrNull());
    }

}