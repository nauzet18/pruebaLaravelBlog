<?php

namespace App\Services;

use App\Interfaces\PersistenceServiceInterface;
use Illuminate\Support\Facades\Http;
use OutOfBoundsException;

class PersistenceServiceApi implements PersistenceServiceInterface
{
    private string $urlBase = '';

    public function __construct()
    {
        $this->urlBase = config('persistence_service_api.url_base', false);
    }

    public function getUser($id): array
    {
        $response = Http::get($this->urlBase.'/users/'.$id);
        $user = $response->json();

        if (empty($user)) {
            throw new OutOfBoundsException("No user data found for ID  $id");
        }

        return $user;
    }

    public function all(): array
    {
        $response = Http::get($this->urlBase.'/posts');

        $elements = $response->json();

        return $response->json();
    }

    public function persist(array $data): array
    {
        $response = Http::post($this->urlBase.'/posts', $data);

        return $response->json();
    }

    public function retrieve(int $id): array
    {
        $response = Http::get($this->urlBase.'/posts/'.$id);

        $element = $response->json();
        if (empty($element)) {
            throw new \OutOfBoundsException("No post found for ID  $id");
        }

        return $element;
    }

    public function update(int $id, array $data): array
    {
        throw new \Exception('No implemented');
    }

    public function delete(int $id)
    {
        throw new \Exception('No implemented');
    }
}
