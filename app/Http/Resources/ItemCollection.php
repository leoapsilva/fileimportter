<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $itemResource = ItemResource::collection($this->collection);
        $itemResourceToArray = $itemResource->toArray($request);

        return [
            'items' => $itemResourceToArray,
        ];
    }
}
