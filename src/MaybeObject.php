<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeObject implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeObject constructor.
     *
     * @param bool $present
     * @param object|null $value
     */
    protected function __construct(bool $present, ?object $value)
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
     * @return object
     */
    public function getValue(): object
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return object|null
     */
    public function getValueOrNull(): ?object
    {
        return $this->value;
    }
}