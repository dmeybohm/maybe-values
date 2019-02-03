<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeCallable implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeCallable constructor.
     *
     * @param bool $present
     * @param callable|null $value
     */
    protected function __construct(bool $present, ?callable $value)
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
     * @return callable
     */
    public function getValue(): callable
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return callable|null
     */
    public function getValueOrNull(): ?callable
    {
        return $this->value;
    }
}