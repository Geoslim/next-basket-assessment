<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->{'id'},
            'title' => $this->{'title'},
            'body' => $this->{'body'},
            'status' => $this->{'status'},
            'user' => UserResource::make($this->whenLoaded('user'))
        ];
    }
}
