<?php

namespace App\Http\Resources;

class StateCollection extends BaseCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = StateResource::class;
}