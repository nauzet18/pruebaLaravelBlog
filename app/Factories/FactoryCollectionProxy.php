<?php

namespace App\Factories;

class FactoryCollectionProxy
{
    protected $instance;

    public function __construct($instance = null)
    {
        $this->instance = $instance;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function newCollection($items = null)
    {
        return collect($items);
    }
}
