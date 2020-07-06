<?php

namespace App\Contracts;

/**
 * Interface ICacheService
 * @package App\Contracts
 */
interface ICacheService
{
    /**
     * Removes the specified keys. A key is ignored if it does not exist.
     *
     * @param  array  $keys
     */
    public function del(array $keys);

    /**
     *  Count the number of keys existing among a given list of keys.
     *
     * @param  array  $keys
     */
    public function exists(array $keys);

    /**
     * Delete all the keys of all the existing databases, not just the currently selected one.
     */
    public function flushAll();

    /**
     * Return the value of key, or nil when key does not exist.
     *
     * @param  $key
     */
    public function get($key);

    /**
     * Rename key to newkey. It returns an error when key does not exist.
     *
     * @param $key
     * @param $newkey
     */
    public function rename($key, $newkey);

    /**
     * Set key to hold the string value.
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value);
}
