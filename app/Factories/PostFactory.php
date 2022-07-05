<?php

namespace App\Factories;

use Illuminate\Support\Fluent;

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
        $userId = $this->faker->numberBetween(1, 10);

        return [
      'id' => $this->faker->unique()->numberBetween(1, 40),
      'userId' => $userId,
      'title' => $this->faker->title,
      'body' => $this->faker->paragraph,
      'user' => [
        'id' => $userId,
        'name' => 'Leanne Graham',
        'username' => 'Bret',
        'email' => 'Sincere@april.biz',
        'address' => [
          'street' => 'Kulas Light',
          'suite' => 'Apt. 556',
          'city' => 'Gwenborough',
          'zipcode' => '92998-3874',
          'geo' => [
            'lat' => '-37.3159',
            'lng' => '81.1496',
          ],
        ],
        'phone' => '1-770-736-8031 x56442',
        'website' => 'hildegard.org',
        'company' => [
          'name' => 'Romaguera-Crona',
          'catchPhrase' => 'Multi-layered client-server neural-net',
          'bs' => 'harness real-time e-markets',
        ],
      ],
    ];
    }
}
