<?php
namespace App\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class ApiFactory extends Factory
{
    public function newModel(array $attributes = [])
    {
        // Here we will pass the model into a proxy, which contains a "newCollection"
        // method, which is required due to its use in the the base Eloquent factory
        // for creating multiple instances of a model using the "times" method.
        return new FactoryCollectionProxy(
            $this->makeModel($this->modelName(), $attributes)
        );
    }

    public function make($attributes = [], ?Model $parent = null)
    {
        $instances = parent::make($attributes, $parent);

        if ($instances instanceof Collection) {
            return $instances->map(function ($instance) {
                return $this->resolveFactoryInstance($instance);
            })
            //->toArray() //Te odio... por q coño pasas esto a array, cargandote como necesita iterar con un collection ResourceCollection
            ;
        }

        return $this->resolveFactoryInstance($instances);
    }

    protected function makeModel($model, array $attributes = [])
    {
        return new $model($attributes);
    }

    protected function resolveFactoryInstance($instance)
    {
        return $instance instanceof FactoryCollectionProxy ? $instance->getInstance() : $instance;
    }
}