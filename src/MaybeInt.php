<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeInt implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeInt constructor.
     *
     * @param bool $present
     * @param int|null $value
     */
    protected function __construct(bool $present, ?int $value)
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
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return int|null
     */
    public function getValueOrNull(): ?int
    {
        return $this->value;
    }

}