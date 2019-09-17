<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expense extends Model
{
    protected $fillable = ['business_id', 'quantity', 'amount'];

    public function scopeBusinessExpenses($query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('m'));
    }

    public function scopeExpensesByBusiness($query, $id)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->where('business_id', $id);
    }

    public function scopeTotalExpensesByBusiness($query, $id)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->where('business_id', $id)
            ->sum('amount');
    }

    public function scopeTotalExpenses($query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->sum('amount');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
