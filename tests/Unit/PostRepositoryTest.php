<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Services\PersistenceServiceInMemory;

class PostRepositoryTest extends TestCase
{
    private PostRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(PostRepository::class, [new PersistenceServiceInMemory()]);
        $this->itemsFake = \App\Factories\PostFactory::new()->times(5)->make();
    }

    /**
     * A test for create a post in repository.
     *
     * @return void
     */
    public function test_create_a_post()
    {
        $data =  \App\Factories\PostFactory::new()->make()->toArray();
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
    public function test_get_all_post()
    {
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data =  $item->toArray();
            unset($data['id']);

            $elements[] = $this->repository->create($data);
        }

        $this->assertEquals($elements, array_values( $this->repository->getAll() ));
    }

    /**
     * A test for get a post from repository.
     *
     * @return void
     */
    public function test_get_a_post()
    {
        $element = $this->repository->create($this->itemsFake->first()->toArray() );

        $this->assertEquals($element, $this->repository->get($element['id']));
    }

    /**
     * A test for update a post in repository.
     *
     * @return void
     */
    public function test_update_a_post()
    {
        $element = $this->repository->create($this->itemsFake->last()->toArray() );
        $element['title'] = 'Nauzet';

        $this->assertEquals($element, $this->repository->update($element['id'], $element) );
    }

    /**
     * A test for not update a post in repository because thow OutOfBoundsException
     *
     * @return void
     */
    public function test_not_update_a_post()
    {
        $element = $this->repository->create($this->itemsFake->last()->toArray() );
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->repository->update($idNoExist, $element);
    }

    /**
     * A test for delete a post from repository.
     *
     * @return void
     */
    public function test_delete_a_post()
    {
        $elements = [];
        foreach ($this->itemsFake as $item) {
            $data =  $item->toArray();
            unset($data['id']);

            $elements[] = $this->repository->create($data);
        }

        $this->repository->delete($elements[0]['id']);

        unset($elements[0]);

        $this->assertEquals(array_values($elements), array_values( $this->repository->getAll() ));
    }

    /**
     * A test for not delete a post in repository because thow OutOfBoundsException
     *
     * @return void
     */
    public function test_not_delete_a_element()
    {
        $element = $this->repository->create($this->itemsFake->last()->toArray() );
        $idNoExist = ++$element['id'];

        $this->expectException(\OutOfBoundsException::class);
        $this->repository->delete($idNoExist);
    }
}
