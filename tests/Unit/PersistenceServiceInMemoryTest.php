<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Interfaces\PersistenceServiceInterface;
use App\Services\PersistenceServiceInMemory;

class PersistenceServiceInMemoryTest extends TestCase
{
    private PersistenceServiceInterface $persistence;

    protected function setUp(): void
    {
        parent::setUp();

        $this->persistence = $this->app->make(PersistenceServiceInMemory::class);
        $this->itemsFake = \App\Factories\PostFactory::new()->times(5)->make();
    }

    /**
     * A test for create a element in persistence.
     *
     * @return void
     */
    public function test_create_a_element()
    {
        $data =  \App\Factories\PostFactory::new()->make()->toArray();
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
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data =  $item->toArray();
            unset($data['id']);

            $elements[] = $this->persistence->persist($data);
        }

        $this->assertEquals($elements, array_values( $this->persistence->all() ));
    }

    /**
     * A test for get a element from persistence.
     *
     * @return void
     */
    public function test_get_a_element()
    {
        $element = $this->persistence->persist($this->itemsFake->first()->toArray() );

        $this->assertEquals($element, $this->persistence->retrieve($element['id']));
    }


    /**
     * A test for update a element in persistence.
     *
     * @return void
     */
    public function test_update_a_element()
    {
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
        $element = $this->persistence->persist($this->itemsFake->last()->toArray() );
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->persistence->delete($idNoExist);
    }
}
