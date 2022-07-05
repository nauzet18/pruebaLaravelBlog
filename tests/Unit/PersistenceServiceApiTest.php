<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

use App\Services\PersistenceServiceApi;

class PersistenceServiceApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->persistence = $this->app->make(PersistenceServiceApi::class);
        $this->itemsFake = \App\Factories\PostFactory::new()->times(5)->make();
        $this->itemFake = $this->itemsFake->first()->toArray();
    }

    /**
     * A test for create a element in persistence.
     *
     * @return void
     */
    public function test_create_a_element()
    {
        Http::fake([
          'https://jsonplaceholder.typicode.com/posts' => Http::response($this->itemFake, 200),
        ]);

        $data =  $this->itemFake;
        unset($data['id']);

        $element = $this->persistence->persist($data);
        unset($element['id']);
        $this->assertEquals($element, $data);
    }

    /**
     * A test for get all element from persistence.
     *
     * @return void
     */
    public function test_get_all_element()
    {
        Http::fake([
          'https://jsonplaceholder.typicode.com/posts' => Http::response($this->itemsFake->toArray(), 200),
          'https://jsonplaceholder.typicode.com/users/*' => Http::response( $this->itemFake['user'] , 200 ),
        ]);

        $this->assertEquals(array_values($this->itemsFake->toArray()), array_values( $this->persistence->all() ));
    }

    /**
     * A test for get a element from persistence.
     *
     * @return void
     */
    public function test_get_a_element()
    {
        Http::fake([
          'https://jsonplaceholder.typicode.com/posts/'.$this->itemFake['id'] => Http::response( $this->itemFake , 200 ),
          'https://jsonplaceholder.typicode.com/users/*' => Http::response( $this->itemFake['user'] , 200 ),
        ]);

        $this->assertEquals($this->itemFake, $this->persistence->retrieve($this->itemFake['id']));
    }


    /**
     * A test for update a element in persistence.
     *
     * @return void
     */
    public function test_update_a_element()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $element = $this->persistence->persist($this->itemsFake->last()->toArray() );
        $element['title'] = 'Nauzet';

        $this->assertEquals($element, $this->persistence->update($element['id'], $element) );
    }

    /**
     * A test for not update a element in persistence because thow OutOfBoundsException
     *
     * @return void
     */
    public function test_not_update_a_element()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $element = $this->persistence->persist($this->itemsFake->last()->toArray() );
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->persistence->update($idNoExist, $element);
    }

    /**
     * A test for delete a element from persistence.
     *
     * @return void
     */
    public function test_delete_a_element()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data =  $item->toArray();
            unset($data['id']);

            $elements[] = $this->persistence->persist($data);
        }

        $this->persistence->delete($elements[0]['id']);

        unset($elements[0]);

        $this->assertEquals(array_values($elements), array_values( $this->persistence->all() ));
    }

    /**
     * A test for not delete a element in persistence because thow OutOfBoundsException
     *
     * @return void
     */
    public function test_not_delete_a_element()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $element = $this->persistence->persist($this->itemsFake->last()->toArray() );
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->persistence->delete($idNoExist);
    }
}
