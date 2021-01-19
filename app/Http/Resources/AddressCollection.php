<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $addressResource = new AddressResource($this->collection);
        $addressResourceToArray = $addressResource->toArray($request);

        return [
            'shipTo' => $addressResourceToArray,
        ];
    }
}
