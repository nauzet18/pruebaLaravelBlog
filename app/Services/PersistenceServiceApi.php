<?php

namespace App\Services;

use OutOfBoundsException;
use Illuminate\Support\Facades\Http;

use App\Interfaces\PersistenceServiceInterface;

class PersistenceServiceApi implements PersistenceServiceInterface
{
    private string $urlBase = '';

    public function __construct()
    {
        $this->urlBase = config('persistence_service_api.url_base', false);
    }

    public function all(): array
    {
        $response = Http::get($this->urlBase.'/posts');

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
            throw new OutOfBoundsException("No data found for ID  $id");
        }

        return $element;
    }

    public function update(int $id, array $data): array
    {
        throw new \Exception("No implemented");
    }

    public function delete(int $id)
    {
        throw new \Exception("No implemented");
    }
}
