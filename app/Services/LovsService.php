<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LovsService extends BaseService
{
    /**
     * Get all countries for LOVs
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllCountries()
    {
        return DB::table('countries')->select('id', 'name', 'abbreviation')->get();
    }

    /**
     * Get all states for LOVs
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllStates()
    {
        return DB::table('states')->select('id', 'name', 'abbreviation', 'country_id')->get();
    }
}