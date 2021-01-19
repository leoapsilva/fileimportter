<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhoneCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $phoneResource = PhoneResource::collection($this->collection);
        $phoneResourceToArray = $phoneResource->toArray($request);

        return [
            'phones' => $phoneResourceToArray,
        ];
    }
}
