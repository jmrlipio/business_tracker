<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Business extends Model
{
    protected $guarded = [];

    public function scopeBusiness($query)
    {
        return $query;
    }

    public function scopeSalesAndExpenses($query)
    {
        return $query->with(['sales', 'expenses']);
    }

    public function scopeBusinessSalesAndExpenses($query, $id)
    {
        return $query->with(['sales', 'expenses'])->where('business_id', $id);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
