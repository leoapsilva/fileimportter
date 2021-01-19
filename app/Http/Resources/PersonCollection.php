<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $personResource = PersonResource::collection($this->collection);
        $personResourceToArray = $personResource->toArray($request);
        
        return [
                'people' => $personResourceToArray,
        ];
    }
}
