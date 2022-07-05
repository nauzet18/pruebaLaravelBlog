<?php

namespace Tests\Unit;

use App\Repositories\PostRepository;
use App\Services\PersistenceServiceInMemory;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(PersistenceServiceInMemory::class, new PersistenceServiceInMemory());

        $this->repository = $this->app->make(PostRepository::class);
        $this->itemsFake = \App\Factories\PostFactory::new()->times(5)->make();
    }

    /**
     * A test for create a post in repository.
     *
     * @return void
     */
    public function testCreateAPost()
    {
        $data = \App\Factories\PostFactory::new()->make()->toArray();
        unset($data['id']);

        $element = $this->repository->create($data);
        unset($element['id']);
        $this->assertEquals($element, $data);
    }

    /**
     * A test for get all post from repository.
     *
     * @return void
     */
    public function testGetAllPost()
    {
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data = $item->toArray();
            unset($data['id']);

            $elements[] = $this->repository->create($data);
        }

        $this->assertEquals($elements, array_values($this->repository->getAll()));
    }

    /**
     * A test for get a post from repository.
     *
     * @return void
     */
    public function testGetAPost()
    {
        $element = $this->repository->create($this->itemsFake->first()->toArray());

        $this->assertEquals($element, $this->repository->get($element['id']));
    }

    /**
     * A test for update a post in repository.
     *
     * @return void
     */
    public function testUpdateAPost()
    {
        $element = $this->repository->create($this->itemsFake->last()->toArray());
        $element['title'] = 'Nauzet';

        $this->assertEquals($element, $this->repository->update($element['id'], $element));
    }

    /**
     * A test for not update a post in repository because thow OutOfBoundsException.
     *
     * @return void
     */
    public function testNotUpdateAPost()
    {
        $element = $this->repository->create($this->itemsFake->last()->toArray());
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->repository->update($idNoExist, $element);
    }

    /**
     * A test for delete a post from repository.
     *
     * @return void
     */
    public function testDeleteAPost()
    {
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data = $item->toArray();
            unset($data['id']);

            $elements[] = $this->repository->create($data);
        }

        $this->repository->delete($elements[0]['id']);

        unset($elements[0]);

        $this->assertEquals(array_values($elements), array_values($this->repository->getAll()));
    }

    /**
     * A test for not delete a post in repository because thow OutOfBoundsException.
     *
     * @return void
     */
    public function testNotDeleteAElement()
    {
        $element = $this->repository->create($this->itemsFake->last()->toArray());
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->repository->delete($idNoExist);
    }
}
