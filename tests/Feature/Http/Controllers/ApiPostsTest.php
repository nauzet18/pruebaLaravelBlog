<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class ApiPostsTest extends TestCase
{
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
