<?php declare(strict_types=1);

namespace Best\NonExistentOrNullable;

abstract class NonExistentOrNullableValue
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
    protected $existent;

    /**
     * Get the value. Throws an exception if the value is an unexpected type, or is null.
     *
     * @return mixed
     */
    abstract public function getValue();

    /**
     * Get the value, or return null if the value is nonexistent or null.
     *
     * @return mixed
     */
    abstract public function getValueOrNull();

    /**
     * Create a new NonExistentOrNullableString from an array and string key.
     *
     * @param array $array
     * @param string $key
     *
     * @return static
     */
    public static function fromArrayAndStringKey(array $array, string $key): self
    {
        return new static(array_key_exists($key, $array), $array[$key] ?? null);
    }

    /**
     * Create a new NonExistentOrNullableString from an array and string key.
     *
     * @param array $array
     * @param int $key
     *
     * @return NonExistentOrNullableValue
     */
    public static function fromArrayAndIntKey(array $array, int $key): self
    {
        return new static(array_key_exists($key, $array), $array[$key] ?? null);
    }

    /**
     * Whether the value is nonexistent or null.
     *
     * @return bool
     */
    public function isNonExistentOrNull(): bool
    {
        return !$this->existent || $this->value === null;
    }

    /**
     * Whether the value is existent and not null.
     *
     * @return bool
     */
    public function isExistentAndNotNull(): bool
    {
        return $this->existent && $this->value !== null;
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
     * Whether the value is nonexistent.
     *
     * @return bool
     */
    public function isNonExistent(): bool
    {
        return !$this->existent;
    }

    /**
     * Whether the value is existent.
     *
     * @return bool
     */
    public function isExistent(): bool
    {
        return $this->existent;
    }
}