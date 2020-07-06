<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class CurrencyRepository
 * @package App\Repositories
 */
class CurrencyRepository
{
    /**
     * Delete all records from currencies table
     *
     * @return void
     */
    public function delete(): void
    {
        DB::table('currencies')->delete();
    }
}
