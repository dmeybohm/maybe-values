<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeMixed implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeString constructor.
     *
     * @param bool $present
     * @param mixed $value
     */
    protected function __construct(bool $present, $value)
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
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return mixed
     */
    public function getValueOrNull()
    {
        return $this->value;
    }
}
