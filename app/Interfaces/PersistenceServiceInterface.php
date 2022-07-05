<?php

namespace App\Interfaces;

interface PersistenceServiceInterface
{
    public function getUser($id): array;

    public function all(): array;

    public function persist(array $data): array;

    public function retrieve(int $id): array;

    public function update(int $id, array $data): array;

    public function delete(int $id);
}