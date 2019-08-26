<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Sale as SaleResource;
use App\Http\Resources\Expense as ExpenseResource;
use App\Http\Resources\Business as BusinessResource;

class Business extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'sales' => SaleResource::collection($this->whenLoaded('sales')),
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses'))
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('http://algotechwebsolutions.com')
        ];
    }
}
