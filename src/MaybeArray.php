<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeArray implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeArray constructor.
     *
     * @param bool $present
     * @param array|null $value
     */
    protected function __construct(bool $present, ?array $value)
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
     * @return array
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return array|null
     */
    public function getValueOrNull(): ?array
    {
        return $this->value;
    }

}