<?php namespace Passkey;

use Stringable;

final class Utils
{
    /**
     * Normalize a PostgreSQL BYTEA (or similar binary column) value returned by drivers. Drivers may return a PHP
     * stream resource, a Stringable object, or a raw string. This method converts those variants to a plain PHP
     * string. Non-string inputs yield an empty string.
     */
    public static function byteaToString(mixed $v): string
    {
        if (is_resource($v)) {
            $data = stream_get_contents($v);
            return $data === false ? '' : $data;
        }
        if ($v instanceof Stringable) {
            return (string) $v;
        }
        return is_string($v) ? $v : '';
    }
}
