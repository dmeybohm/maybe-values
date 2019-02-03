<?php declare(strict_types=1);

namespace Best\Maybe;

final class MaybeResource implements MaybeValue
{
    use MaybeTrait;

    /**
     * MaybeResource constructor.
     *
     * @param bool $present
     * @param resource|null $value
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
     * @return resource
     */
    public function getValue()
    {
        $this->checkIsResource();
        return $this->value;
    }

    /**
     * Get the value, or return null if the value is non-existent or null.
     *
     * @return resource|null
     */
    public function getValueOrNull()
    {
        $this->checkIsResourceOrNull();
        return $this->value;
    }

    /**
     * Check the value is a resource or null and throw an exception if not.
     *
     * @return void
     */
    private function checkIsResourceOrNull(): void
    {
        if ($this->value === null) {
            return;
        }
        $this->checkIsResource();
    }

    /**
     * Check the value is a resource and throw an exception if not.
     *
     * @return void
     */
    private function checkIsResource(): void
    {
        if (!is_resource($this->value)) {
            throw new \TypeError("Value must be a resource or null");
        }
    }
}