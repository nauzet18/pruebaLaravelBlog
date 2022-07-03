<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //TODO: como una casa... veo que esto espera un objeto Fluent o simimlar para que el this->id pueda tirar.. así que hago trampas  y me pienso si hago q mi respositorio devuelva directamente un objeto Fluen, en vez de un array,... q es de todo menos bonito

        if (is_array($this->resource))
            $resource = new \Illuminate\Support\Fluent($this->resource);
        else
            $resource = $this->resource;

        return [
            'id'=> $resource->id,
            'userId'=> $resource->userId,
            'title'=> $resource->title,
            'body'=> $resource->body,
        ];
    }
}
