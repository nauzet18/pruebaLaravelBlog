<?php

namespace Tests\Unit;

use App\Services\PersistenceServiceInMemory;
use Tests\TestCase;

class PersistenceServiceInMemoryTest extends TestCase
{
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
    public function testCreateAElement()
    {
        $data = \App\Factories\PostFactory::new()->make()->toArray();
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
    public function testGetAllElement()
    {
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data = $item->toArray();
            unset($data['id']);

            $elements[] = $this->persistence->persist($data);
        }

        $this->assertEquals($elements, array_values($this->persistence->all()));
    }

    /**
     * A test for get a element from persistence.
     *
     * @return void
     */
    public function testGetAElement()
    {
        $element = $this->persistence->persist($this->itemsFake->first()->toArray());

        $this->assertEquals($element, $this->persistence->retrieve($element['id']));
    }

    /**
     * A test for update a element in persistence.
     *
     * @return void
     */
    public function testUpdateAElement()
    {
        $element = $this->persistence->persist($this->itemsFake->last()->toArray());
        $element['title'] = 'Nauzet';

        $this->assertEquals($element, $this->persistence->update($element['id'], $element));
    }

    /**
     * A test for not update a element in persistence because thow OutOfBoundsException.
     *
     * @return void
     */
    public function testNotUpdateAElement()
    {
        $element = $this->persistence->persist($this->itemsFake->last()->toArray());
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->persistence->update($idNoExist, $element);
    }

    /**
     * A test for delete a element from persistence.
     *
     * @return void
     */
    public function testDeleteAElement()
    {
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data = $item->toArray();
            unset($data['id']);

            $elements[] = $this->persistence->persist($data);
        }

        $this->persistence->delete($elements[0]['id']);

        unset($elements[0]);

        $this->assertEquals(array_values($elements), array_values($this->persistence->all()));
    }

    /**
     * A test for not delete a element in persistence because thow OutOfBoundsException.
     *
     * @return void
     */
    public function testNotDeleteAElement()
    {
        $element = $this->persistence->persist($this->itemsFake->last()->toArray());
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->persistence->delete($idNoExist);
    }
}
