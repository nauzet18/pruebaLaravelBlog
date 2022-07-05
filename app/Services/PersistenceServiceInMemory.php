<?php

namespace App\Services;

use OutOfBoundsException;
use App\Interfaces\PersistenceServiceInterface;

class PersistenceServiceInMemory implements PersistenceServiceInterface
{
    private array $data = [];
    private int $lastId = 0;

    private function generateId(): int
    {
        $this->lastId++;

        return $this->lastId;
    }

    public function getUser($id): array
    {
        $item = collect($this->data)->first(function ($item, $key) use($id) {
            return $item['userId']== $id;
        });

        if( isset($item['user']))
            $user = $item['user'];
        else
            $user = null;

        if (empty($user)) {
            throw new OutOfBoundsException("No user data found for ID  $id");
        }

        return $user;
    }

    public function all(): array
    {
        return $this->data;
    }

    public function persist(array $data): array
    {
        $data['id'] = $this->generateId();

        $this->data[$this->lastId] = $data;

        return $data;
    }

    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException("No data found for ID  $id");
        }

        return $this->data[$id];
    }

    public function update(int $id, array $data): array
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException("No data found for ID  $id");
        }

        return $this->data[$id] = $data;
    }

    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException("No data found for ID  $id");
        }

        unset($this->data[$id]);
    }
}
