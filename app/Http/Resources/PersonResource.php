<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    public static $wrap = 'people';

    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $phoneResource = PhoneResource::collection($this->phones);
        $phoneResourceToArray = $phoneResource->toArray($request);
        
        return [
                'personid' => $this->id,
                'personname' => $this->first_name,
                'phones' => $phoneResourceToArray,
        ];
    }

    //$pe = PersonResource::collection(Person::with('phones')->get());
    //$pe->toArray(request())
}
