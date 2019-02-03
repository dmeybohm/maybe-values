<?php declare(strict_types=1);

namespace Best\Maybe\Test;

use Best\Maybe\MaybeBool;
use Best\Maybe\MaybeCallable;
use Best\Maybe\MaybeFloat;
use Best\Maybe\MaybeInt;
use Best\Maybe\MaybeIterable;
use Best\Maybe\MaybeObject;
use Best\Maybe\MaybeResource;
use Best\Maybe\MaybeString;
use Best\Maybe\MaybeValue;

class TestAll extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideValues
     */
    public function testfromArrayAndKey(string $className, array $array, string $key, array $expected)
    {
        $maybeValue = $className::fromArrayAndKey($array, $key);
        /** @var MaybeValue $maybeValue */

        $this->assertSame($expected['isPresentAndNotNull'], $maybeValue->isPresentAndNotNull());
        $this->assertSame($expected['isMissing'], $maybeValue->isMissing());
        $this->assertSame($expected['isMissingOrNull'], $maybeValue->isMissingOrNull());
        $this->assertSame($expected['getValueOrNull'], $maybeValue->getValueOrNull());

        if ($expected['getValue'] instanceof \Throwable) {
            $this->expectException(get_class($expected['getValue']));
            $maybeValue->getValue();

        } else {
            $this->assertSame($expected['getValue'], $maybeValue->getValue());
        }
    }

    /**
     * @dataProvider provideValues
     */
    public function testfromArrayAccesAndKey(string $className, array $array, string $key, array $expected)
    {
        $object = new \ArrayObject($array);

        $maybeValue = $className::fromArrayAccessAndKey($object, $key);
        /** @var MaybeValue $maybeValue */

        $this->assertSame($expected['isPresentAndNotNull'], $maybeValue->isPresentAndNotNull());
        $this->assertSame($expected['isMissing'], $maybeValue->isMissing());
        $this->assertSame($expected['isMissingOrNull'], $maybeValue->isMissingOrNull());
        $this->assertSame($expected['getValueOrNull'], $maybeValue->getValueOrNull());

        if ($expected['getValue'] instanceof \Throwable) {
            $this->expectException(get_class($expected['getValue']));
            $maybeValue->getValue();

        } else {
            $this->assertSame($expected['getValue'], $maybeValue->getValue());
        }
    }

    /**
     * @dataProvider provideValues
     */
    public function testfromAObjectAndProperty(string $className, array $array, string $key, array $expected)
    {
        $object = (object)$array;

        $maybeValue = $className::fromObjectAndProperty($object, $key);
        /** @var MaybeValue $maybeValue */

        $this->assertSame($expected['isPresentAndNotNull'], $maybeValue->isPresentAndNotNull());
        $this->assertSame($expected['isMissing'], $maybeValue->isMissing());
        $this->assertSame($expected['isMissingOrNull'], $maybeValue->isMissingOrNull());
        $this->assertSame($expected['getValueOrNull'], $maybeValue->getValueOrNull());

        if ($expected['getValue'] instanceof \Throwable) {
            $this->expectException(get_class($expected['getValue']));
            $maybeValue->getValue();

        } else {
            $this->assertSame($expected['getValue'], $maybeValue->getValue());
        }
    }

    public function provideValues()
    {
        $file = fopen(__FILE__, 'r');

        $closure = function () {
        };

        $stdClass = new \stdClass;

        return [
            'non-null' => [
                'className' => MaybeString::class,
                'array' => [
                    'non-null' => 'value'
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => 'value',
                    'getValue' => 'value',
                ],
            ],
            'with key and null' => [
                'className' => MaybeString::class,
                'array' => [
                    'non-null' => null
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => false,
                    'isMissing' => false,
                    'isMissingOrNull' => true,
                    'getValueOrNull' => null,
                    'getValue' => new \TypeError(),
                ]
            ],
            'non-existent' => [
                'className' => MaybeString::class,
                'array' => [
                ],
                'key' => 'non-existent',
                'expected' => [
                    'isPresentAndNotNull' => false,
                    'isMissing' => true,
                    'isMissingOrNull' => true,
                    'getValueOrNull' => null,
                    'getValue' => new \TypeError(),
                ]
            ],
            'resource' => [
                'className' => MaybeResource::class,
                'array' => [
                    'non-null' => $file
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => $file,
                    'getValue' => $file,
                ],
            ],
            'iterable' => [
                'className' => MaybeIterable::class,
                'array' => [
                    'non-null' => ['an array']
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => ['an array'],
                    'getValue' => ['an array'],
                ],
            ],
            'callable' => [
                'className' => MaybeCallable::class,
                'array' => [
                    'non-null' => $closure
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => $closure,
                    'getValue' => $closure,
                ],
            ],
            'object' => [
                'className' => MaybeObject::class,
                'array' => [
                    'non-null' => $stdClass
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => $stdClass,
                    'getValue' => $stdClass,
                ],
            ],
            'int' => [
                'className' => MaybeInt::class,
                'array' => [
                    'non-null' => 1
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => 1,
                    'getValue' => 1,
                ],
            ],
            'float' => [
                'className' => MaybeFloat::class,
                'array' => [
                    'non-null' => 1.5
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => 1.5,
                    'getValue' => 1.5,
                ],
            ],
            'bool' => [
                'className' => MaybeBool::class,
                'array' => [
                    'non-null' => true
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => true,
                    'getValue' => true,
                ],
            ],

        ];
    }

    /**
     * @dataProvider provideLooseValues
     */
    public function testFilteredFactoryMethods($className, $methodName, $array, $key, $expected)
    {
        $maybeValue = $className::$methodName($array, $key);
        /** @var MaybeValue $maybeValue */

        $this->assertSame($expected['isPresentAndNotNull'], $maybeValue->isPresentAndNotNull());
        $this->assertSame($expected['isMissing'], $maybeValue->isMissing());
        $this->assertSame($expected['isMissingOrNull'], $maybeValue->isMissingOrNull());
        $this->assertSame($expected['getValueOrNull'], $maybeValue->getValueOrNull());

        if ($expected['getValue'] instanceof \Throwable) {
            $this->expectException(get_class($expected['getValue']));
            $maybeValue->getValue();

        } else {
            $this->assertSame($expected['getValue'], $maybeValue->getValue());
        }
    }

    public function provideLooseValues()
    {
        return [
            'bool true' => [
                'className' => MaybeBool::class,
                'methodName' => 'fromArrayAndKeyFiltered',
                'array' => [
                    'non-null' => '1',
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => true,
                    'getValue' => true,
                ],
            ],
            'bool false' => [
                'className' => MaybeBool::class,
                'methodName' => 'fromArrayAndKeyFiltered',
                'array' => [
                    'non-null' => '0',
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => false,
                    'getValue' => false,
                ],
            ],
            'int' => [
                'className' => MaybeInt::class,
                'methodName' => 'fromArrayAndKeyFiltered',
                'array' => [
                    'non-null' => '12',
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => 12,
                    'getValue' => 12,
                ],
            ],
            'float' => [
                'className' => MaybeFloat::class,
                'methodName' => 'fromArrayAndKeyFiltered',
                'array' => [
                    'non-null' => '12.5',
                ],
                'key' => 'non-null',
                'expected' => [
                    'isPresentAndNotNull' => true,
                    'isMissing' => false,
                    'isMissingOrNull' => false,
                    'getValueOrNull' => 12.5,
                    'getValue' => 12.5,
                ],
            ],
        ];
    }


}