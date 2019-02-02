<?php declare(strict_types=1);

namespace Best\Maybe;

interface MaybeValue
{
    /**
     * Get the value. Throws an exception if the value is an unexpected type, or is null.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Get the value, or return null if the value is not present or null.
     *
     * @return mixed
     */
    public function getValueOrNull();

    /**
     * Whether the value is NotPresent or null.
     *
     * @return bool
     */
    public function isMissingOrNull(): bool;

    /**
     * Whether the value is existent and not null.
     *
     * @return bool
     */
    public function isPresentAndNotNull(): bool;

    /**
     * Whether the value is null.
     *
     * @return bool
     */
    public function isNull(): bool;

    /**
     * Whether the value is NotPresent.
     *
     * @return bool
     */
    public function isMissing(): bool;

    /**
     * Whether the value is existent.
     *
     * @return bool
     */
    public function isPresent(): bool;
}