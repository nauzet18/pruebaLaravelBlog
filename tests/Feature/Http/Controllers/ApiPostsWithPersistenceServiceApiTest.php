<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

use App\Services\PersistenceServiceApi;
use App\Repositories\PostRepository;

class ApiPostsWithPersistenceServiceApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        //NOTA: Tengo q ver como hacer para q se instancie  PersistenceServiceApi en vez de PersistenceServiceInMemory
        // para eso tengo q ver como hacerlo, pero sospecho q  con mockery (pero se me resiste)
    }

    public function test_get_all_posts()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
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
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
        $response = $this->get('/api/posts/1');
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

}
