<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImportFileResource extends JsonResource
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
        return [
                'id'            => $this->id,
                'created_at'    => $this->created_at,
                'updated_at'    => $this->updated_at,
                'user_id'       => $this->user_id,
                'filename'      => $this->filename, 
                'count'         => $this->count,
                'model'         => $this->model,
                'status'        => $this->status,
        ];
    }
}
