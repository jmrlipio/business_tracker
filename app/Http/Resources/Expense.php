<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Expense extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'business_id' => $this->business_id,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'created_at' => $this->created_at
        ];
    }
    
    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('http://algotechwebsolutions.com')
        ];
    }
}
