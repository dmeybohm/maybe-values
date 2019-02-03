<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeIterable implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeIterable constructor.
     *
     * @param bool $present
     * @param iterable|null $value
     */
    protected function __construct(bool $present, ?iterable $value)
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
     * @return iterable
     */
    public function getValue(): iterable
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return iterable|null
     */
    public function getValueOrNull(): ?iterable
    {
        return $this->value;
    }
}