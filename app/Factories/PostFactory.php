<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Fluent;
use Faker\Generator as Faker;


class PostFactory extends ApiFactory
{
  protected $model = Fluent::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'id'=> $this->faker->unique()->numberBetween(1,40),
      'userId'=> $this->faker->numberBetween(1,10),
      'title'=> $this->faker->title,
      'body'=> $this->faker->paragraph,
    ];
  }
}
