<?php

namespace Tests\Feature\Http\Controllers;

use App\Repositories\PostRepository;
use App\Services\PersistenceServiceApi;
use App\Services\PersistenceServiceInMemory;
use Tests\TestCase;

class ApiPostsWithPersistenceServiceApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // NOTA: Tengo q ver como hacer para q se instancie  PersistenceServiceApi en vez de PersistenceServiceInMemory
        // para eso tengo q ver como hacerlo, pero sospecho q  con mockery (pero se me resiste)

        $this->persistence = new PersistenceServiceInMemory();

        $this->itemsFake = \App\Factories\PostFactory::new()->times(5)->make();
        foreach ($this->itemsFake as $item) {
            $data = $item->toArray();
            unset($data['id']);

            $elements[] = $this->persistence->persist($data);
        }
        $this->itemFake = $elements[0];

        $this->app->instance(PersistenceServiceInMemory::class, $this->persistence);
        $this->repository = $this->app->make(PostRepository::class);
    }

    public function testGetAllPosts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200)
                 ->assertJsonMissing(['data' => []]) // No empty collection data
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                             'id',
                             'userId',
                             'title',
                             'body',
                             'user',
                        ],
                    ],
                 ])
                 ;
    }

    public function testGetAPost()
    {
        $response = $this->get('/api/posts/'.$this->itemFake['id']);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'data' => [
                                'id',
                                'userId',
                                'title',
                                'body',
                                'user',
                    ],
                 ])
                 ;
    }

    public function testPostAPost()
    {
        $itemFake = $this->itemFake;
        unset($itemFake['id']);

        $response = $this->post('/api/posts', $this->itemFake);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'data' => [
                                'id',
                                'userId',
                                'title',
                                'body',
                    ],
                 ])
                 ->assertJsonFragment($itemFake)
                 ;
    }
}
