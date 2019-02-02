<?php declare(strict_types=1);

namespace Best\NonExistentOrNullable;

final class NonExistentOrNullableArray extends NonExistentOrNullableValue
{
    /**
     * NonExistentOrNullableString constructor.
     *
     * @param bool $existent
     * @param array|null $value
     */
    protected function __construct(bool $existent, ?array $value)
    {
        $this->existent = $existent;
        $this->value = $value;
    }

    /**
     * Get the value.
     *
     * Note this will throw an exception if you try to get the value and it's nonexistent or null.
     *
     * So you have to check the value is present before getting the value.
     *
     * @return bool
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return bool|null
     */
    public function getValueOrNull(): ?array
    {
        return $this->existent && $this->value !== null ? $this->value : null;
    }

}