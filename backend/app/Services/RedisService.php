<?php

namespace App\Services;

use App\Contracts\ICacheService;
use Illuminate\Support\Facades\Redis;

/**
 * Class RedisService
 * @package App\Services
 */
class RedisService implements ICacheService
{
    /**
     * If key already exists and is a string,
     * this command appends the value at the end of the string.
     * If key does not exist it is created and set as an empty string
     *
     * Return the length of the string after the append operation.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function append($key, $value)
    {
        return Redis::append($key, $value);
    }

    /**
     * Removes the specified keys. A key is ignored if it does not exist.
     *
     * Return the number of keys that were removed.
     *
     * @param  array  $keys
     * @return mixed
     */
    public function del(array $keys)
    {
        return Redis::del(...$keys);
    }

    /**
     * Count the number of keys existing among a given list of keys.
     *
     * Return the quantity of existing keys.
     * Keys mentioned repeatedly will be counted repeatedly. Nonexistent keys won't be counted.
     *
     * @param  array  $keys
     * @return mixed
     */
    public function exists(array $keys)
    {
        return Redis::exists(...$keys);
    }

    /**
     * Set a timeout on key. After the timeout has expired, the key will automatically be deleted.
     * If a given key already has expire set. In this case the time to live of a key will
     * update to the new value.
     * Time to live specify in number of seconds.
     *
     * Return 1 if the timeout was set or 0 if key does not exist.
     *
     * @param $key
     * @param  int  $ttl
     * @return mixed
     */
    public function expire($key, int $ttl)
    {
        return Redis::expire($key, $ttl);
    }

    /**
     * Has the same effect and semantic as EXPIRE.
     * Time to live specify in Unix timestamp.
     *
     * Return 1 if the timeout was set or 0 if key does not exist.
     *
     * @param $key
     * @param  int  $ttl
     * @return mixed
     */
    public function expireat($key, int $ttl)
    {
        return Redis::expireat($key, $ttl);
    }

    /**
     * Delete all the keys of all the existing databases, not just the currently selected one.
     *
     * @return mixed
     */
    public function flushAll()
    {
        return Redis::flushAll();
    }

    /**
     * Delete all the keys of the currently selected DB.
     *
     * @return mixed
     */
    public function flushDb()
    {
        return Redis::flushDb();
    }

    /**
     * Return the value of key, or nil when key does not exist.
     *
     * @param  $key
     * @return mixed
     */
    public function get($key)
    {
        return Redis::get($key);
    }

    /**
     * Atomically sets key to value and returns the old value stored at key.
     *
     * Return the old value stored at key, nil when key did not exist or error when key
     * exists but does not hold a string value.
     *
     * @param  $key
     * @return mixed
     */
    public function getSet($key)
    {
        return Redis::getSet($key);
    }

    /**
     * Return array the values of all specified keys.
     * For every key that does not hold a string value or does not exist,
     * the special value nil is returned.
     *
     * @param  array  $keys
     * @return mixed
     */
    public function mGet(array $keys)
    {
        return Redis::mGet(...$keys);
    }

    /**
     * Sets the given keys to their respective values.
     * MSET replaces existing values with new values, just as regular SET.
     * Input array must contain pairs key => value.
     *
     * @param  array  $associative
     * @return mixed
     */
    public function mSet(array $associative)
    {
        $arr = [];
        foreach ($associative as $key => $val) {
            $arr[] = $key;
            $arr[] = $val;
        }
        return Redis::mSet(...$arr);
    }

    /**
     * Rename key to newkey. It returns an error when key does not exist.
     * If newkey already exists it is overwritten.
     *
     * @param $key
     * @param $newkey
     * @return mixed
     */
    public function rename($key, $newkey)
    {
        return Redis::rename($key, $newkey);
    }

    /**
     * Set key to hold the string value. If key already holds a value, it is overwritten,
     * regardless of its type.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return Redis::set($key, $value);
    }

    /**
     * Insert all the specified values at the tail of the list stored at key.
     * If key does not exist, it is created as empty list before performing the push operation.
     * When key holds a value that is not a list, an error is returned.
     *
     * @param $list
     * @param $value
     * @return mixed
     */
    public function rPush($list, $value)
    {
        return Redis::rPush($list, $value);
    }
}
