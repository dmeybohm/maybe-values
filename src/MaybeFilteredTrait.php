<?php declare(strict_types=1);

namespace Best\Maybe;

trait MaybeFilteredTrait
{
    /**
     * Create a new MaybeValue from a filtered expression on the contents of an array key.
     *
     * @param array $array
     * @param string|int $key
     *
     * @return static
     */
    public static function fromArrayAndKeyFiltered(array $array, $key)
    {
        if (array_key_exists($key, $array)) {
            return new static(true, self::filterVar($array[$key], $key));
        } else {
            return new static(false, null);
        }
    }

    /**
     * Create a new MaybeValue from a filtered expression on the contents of an ArrayAccess key.
     *
     * @param array $array
     * @param string|int $key
     *
     * @return static
     */
    public static function fromArrayAccessibleAndKeyFiltered(\ArrayAccess $array, $key)
    {
        if ($array->offsetExists($key)) {
            return new static(true, self::filterVar($array[$key], $key));
        } else {
            return new static(false, null);
        }
    }

    /**
     * Create a new MaybeValue from a filtered expression from the value of a property on an object.
     *
     * @param object $object
     * @param string $property
     *
     * @return static
     */
    public static function fromObjectAndPropertyFiltered(object $object, string $property)
    {
        if (property_exists($object, $property)) {
            return new static(true, self::filterVar($object->$property, $property));
        } else {
            return new static(false, null);
        }
    }

    /**
     * Filter the var and return the type.
     *
     * @param mixed $value
     * @return mixed
     */
    private static function filterVar($value, $key)
    {
        $var = filter_var($value, self::FILTER_TYPE, FILTER_NULL_ON_FAILURE);
        if ($var === null) {
            throw new \InvalidArgumentException(
                sprintf('Error retrieving key "%s": filter failed"', $key)
            );
        }
        return $var;
    }
}