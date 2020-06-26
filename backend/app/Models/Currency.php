<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Currency
 * @package App
 */
class Currency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_id',
        'num_code',
        'char_code',
        'nominal',
        'name',
        'value',
        'past_value'
    ];

    /**
     * @return Currency[]|Collection
     */
    public function getAll()
    {
        return self::all();
    }
}
