<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeBool implements MaybeValue
{
    use MaybeTrait;
    use MaybeFilteredTrait;

    private const FILTER_TYPE = FILTER_VALIDATE_BOOLEAN;

    /**
     * MaybeBool constructor.
     *
     * @param bool $present
     * @param bool|null $value
     */
    protected function __construct(bool $present, ?bool $value)
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
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return bool|null
     */
    public function getValueOrNull(): ?bool
    {
        return $this->value;
    }
}