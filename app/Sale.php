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
        return $query->select(DB::raw('YEAR(created_at) as sales_year, 
        MONTH(created_at) as sales_month, DAY(created_at) as sales_day,
        SUM(amount) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at), DAY(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), DAY(created_at)'))
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->get();
    }

    public function scopeMonthlySales($query)
    {
        return $query->select(DB::raw('YEAR(created_at) as sales_year, MONTH(created_at) as sales_month,
        SUM(amount) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();
    }

    public function scopeYearlySales($query)
    {
        return $query->select(DB::raw('YEAR(created_at) as sales_year, SUM(amount) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->get();
    }

    public function scopeBusinessDailySales($query, $id)
    {
        return $query->select(DB::raw('YEAR(created_at) as sales_year, 
        MONTH(created_at) as sales_month, DAY(created_at) as sales_day,
        SUM(amount) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at), DAY(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), DAY(created_at)'))
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->where('business_id',$id);
    }

    public function scopeBusinessMonthlySales($query, $id)
    {
        return $query->select(DB::raw('YEAR(created_at) as sales_year, MONTH(created_at) as sales_month,
        SUM(amount) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->where('business_id',$id);
    }

    public function scopeBusinessYearlySales($query, $id)
    {
        return $query->select(DB::raw('YEAR(created_at) as sales_year, SUM(amount) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->where('business_id',$id);
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
