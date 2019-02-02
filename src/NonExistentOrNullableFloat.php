<?php declare(strict_types=1);

namespace Best\NonExistentOrNullable;

final class NonExistentOrNullableFloat extends NonExistentOrNullableValue
{
    /**
     * NonExistentOrNullableString constructor.
     *
     * @param bool $existent
     * @param float|null $value
     */
    protected function __construct(bool $existent, ?float $value)
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
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return bool|null
     */
    public function getValueOrNull(): ?float
    {
        return $this->existent && $this->value !== null ? $this->value : null;
    }

}