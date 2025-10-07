<?php

namespace App\Http\Resources;

class CountryCollection extends BaseCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = CountryResource::class;
}