<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

use App\Services\PersistenceServiceInMemory;
use App\Repositories\PostRepository;

class ApiPostsWithPersistenceServiceInMemoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(PersistenceServiceInMemory::class, new PersistenceServiceInMemory());

        $this->repository = $this->app->make(PostRepository::class);
        $this->itemsFake = \App\Factories\PostFactory::new()->times(5)->make();

        foreach ($this->itemsFake as $item) {
            $data =  $item->toArray();
            unset($data['id']);

            $this->repository->create($data);
        }
        $this->itemFake = $this->itemsFake->first()->toArray();
    }

    public function test_get_all_posts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                             'id',
                             'userId',
                             'title',
                             'body',
                        ]
                    ]
                 ])
                 ;
    }

    public function test_get_a_post()
    {
        $firstPost = collect ($this->repository->getAll())->first();

        $response = $this->get('/api/posts/'.$firstPost['id']);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'data' => [
                                'id',
                                'userId',
                                'title',
                                'body',
                    ]
                 ])
                 ;
    }

    public function test_post_a_post()
    {
        $itemFake =  $this->itemFake;
        unset($itemFake['id']);

        $response = $this->post('/api/posts', $this->itemFake);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'data' => [
                                'id',
                                'userId',
                                'title',
                                'body',
                    ]
                 ])
                 ->assertJsonFragment( $itemFake )
                 ;
    }
}
