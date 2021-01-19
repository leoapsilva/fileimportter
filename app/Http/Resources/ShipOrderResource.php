<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipOrderResource extends JsonResource
{
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $itemResource = ItemResource::collection($this->items);
        $itemResourceToArray = $itemResource->toArray($request);

        $addressResource = new AddressResource($this->shipTo);
        $addressResourceToArray = $addressResource->toArray($request);

        return [
            'shiporder' => [
                            'shipto' => $addressResourceToArray,
                            'items' => $itemResourceToArray,
            ]
        ];

    }
}
