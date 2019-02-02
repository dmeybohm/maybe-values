<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeString implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeString constructor.
     *
     * @param bool $present
     * @param string|null $value
     */
    protected function __construct(bool $present, ?string $value)
    {
        $this->present = $present;
        $this->value = $value;
    }

    /**
     * Get the value.
     *
     * Note this will throw an exception if you try to get the value and it's not present or null.
     *
     * So you have to check the value is present before getting the value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return string|null
     */
    public function getValueOrNull(): ?string
    {
        return $this->present && $this->value !== null ? $this->value : null;
    }

}