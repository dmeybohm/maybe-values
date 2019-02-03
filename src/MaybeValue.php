<?php declare(strict_types=1);

namespace Best\Maybe;

interface MaybeValue
{
    /**
     * Whether the value is present. The value may still be null.
     *
     * @return bool
     */
    public function isPresent(): bool;

    /**
     * Whether the value is present and not null.
     *
     * @return bool
     */
    public function isPresentAndNotNull(): bool;

    /**
     * Whether the value is not present. This is the inverse of "present".
     *
     * @return bool
     */
    public function isMissing(): bool;

    /**
     * Whether the value is not present or null.
     *
     * @return bool
     */
    public function isMissingOrNull(): bool;

    /**
     * Whether the value is null.
     *
     * @return bool
     */
    public function isNull(): bool;

    /**
     * Get the value.
     *
     * Throws a TypeError if the value is an unexpected type, or is null.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Get the value, or return null if the value is not present or null.
     *
     * Throws a TypeError if the value is an unexpected type.
     *
     * @return mixed
     */
    public function getValueOrNull();
}