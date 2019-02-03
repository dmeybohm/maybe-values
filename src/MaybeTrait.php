<?php declare(strict_types=1);

namespace Best\Maybe;

trait MaybeTrait
{
    /**
     * The value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Whether the value is present.
     *
     * @var bool
     */
    protected $present;

    /**
     * Get the value. Throws an exception if the value is an unexpected type, or is null.
     *
     * @return mixed
     */
    abstract public function getValue();

    /**
     * Get the value, or return null if the value is not present or null.
     *
     * @return mixed
     */
    abstract public function getValueOrNull();

    /**
     * Create a new MaybeValue from an array and string or int key within it.
     *
     * @param array $array
     * @param string|int $key
     *
     * @return static
     */
    public static function fromArrayAndKey(array $array, $key): self
    {
        if (array_key_exists($key, $array)) {
            return new static(true, $array[$key]);
        } else {
            return new static(false, null);
        }
    }

    /**
     * Create a new MaybeValue from an ArrayAccess object and key.
     *
     * @param \ArrayAccess $arrayAccessible
     * @param mixed $key
     *
     * @return static
     */
    public static function fromArrayAccessibleAndKey(\ArrayAccess $arrayAccessible, $key): self
    {
        if ($arrayAccessible->offsetExists($key)) {
            return new static(true, $arrayAccessible[$key]);
        } else {
            return new static(false, null);
        }
    }

    /**
     * Create a new MaybeValue from an object and a string property.
     *
     * @param object $object
     * @param string $property
     * @return static
     */
    public static function fromObjectAndProperty(object $object, string $property): self
    {
        if (property_exists($object, $property)) {
            return new static(true, $object->$property);
        } else {
            return new static(false, null);
        }
    }

    /**
     * Whether the value is not present or null.
     *
     * @return bool
     */
    public function isMissingOrNull(): bool
    {
        return !$this->present || $this->value === null;
    }

    /**
     * Whether the value is present and not null.
     *
     * @return bool
     */
    public function isPresentAndNotNull(): bool
    {
        return $this->present && $this->value !== null;
    }
 
    /**
     * Whether the value is null.
     *
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }

    /**
     * Whether the value is present.
     *
     * @return bool
     */
    public function isPresent(): bool
    {
        return $this->present;
    }
    /**
     * Whether the value is not present.
     *
     * @return bool
     */
    public function isMissing(): bool
    {
        return !$this->present;
    }


}