<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShipOrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $shipOrderResource = ShipOrderResource::collection($this->collection);
        $shipOrderResourceToArray = $shipOrderResource->toArray($request);

        return [
            'shiporders' => $shipOrderResourceToArray,
        ];
    }
}
