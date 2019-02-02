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
     * Whether the value was existent.
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
     * Get the value, or return null if the value is NotPresent or null.
     *
     * @return mixed
     */
    abstract public function getValueOrNull();

    /**
     * Create a new MaybeValue an array and string key within it.
     *
     * @param array $array
     * @param string $key
     *
     * @return static
     */
    public static function fromArrayAndStringKey(array $array, string $key): self
    {
        if (array_key_exists($key, $array)) {
            return new static(true, $array[$key]);
        } else {
            return new static(false, null);
        }
    }

    /**
     * Create a new MaybeValue from an array and int key within it.
     *
     * @param array $array
     * @param int $key
     *
     * @return MaybeTrait
     */
    public static function fromArrayAndIntKey(array $array, int $key): self
    {
        if (array_key_exists($key, $array)) {
            return new static(true, $array[$key]);
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
     * Whether the value is NotPresent or null.
     *
     * @return bool
     */
    public function isMissingOrNull(): bool
    {
        return !$this->present || $this->value === null;
    }

    /**
     * Whether the value is existent and not null.
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
     * Whether the value is NotPresent.
     *
     * @return bool
     */
    public function isMissing(): bool
    {
        return !$this->present;
    }

    /**
     * Whether the value is existent.
     *
     * @return bool
     */
    public function isPresent(): bool
    {
        return $this->present;
    }
}