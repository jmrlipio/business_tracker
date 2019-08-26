<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Sale extends Model
{
    protected $fillable = ['business_id', 'amount'];

    public function scopeSales($query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('m'));
    }

    public function scopeDailySales($query)
    {
        return $query->sum('amount');
    }

    public function scopeBusinessSales($query, $id)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->where('business_id', $id);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
