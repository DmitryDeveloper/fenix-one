<?php

namespace App\Contracts;

/**
 * Interface ICacheService
 * @package App\Contracts
 */
interface ICacheService
{
    /**
     * @param $key
     * @param $value
     */
    public function append($key, $value);

    /**
     * @param  array  $keys
     */
    public function del(array $keys);

    /**
     * @param  array  $keys
     */
    public function exists(array $keys);

    /**
     * @param $key
     * @param  int  $ttl
     */
    public function expire($key, int $ttl);

    /**
     * @param $key
     * @param  int  $ttl
     */
    public function expireat($key, int $ttl);

    public function flushAll();

    public function flushDb();

    /**
     * @param  $key
     */
    public function get($key);

    /**
     * @param  $key
     */
    public function getSet($key);

    /**
     * @param  array  $keys
     */
    public function mGet(array $keys);

    /**
     * @param  array  $associative
     */
    public function mSet(array $associative);

    /**
     * @param $key
     * @param $newkey
     */
    public function rename($key, $newkey);

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value);
}
