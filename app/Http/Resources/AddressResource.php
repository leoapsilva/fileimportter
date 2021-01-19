<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'ship_order_id' => $this->ship_order_id,
                'name'          => $this->name,
                'address'       => $this->address_1,
                'city'          => $this->city,
                'country'       => $this->country,
        ];
    }
}
