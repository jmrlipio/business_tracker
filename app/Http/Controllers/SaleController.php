<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Sale;
use App\Business;
use App\Expense;
use App\Http\Resources\Sale as SaleResource;
use App\Http\Resources\Business as BusinessResource;
use App\Http\Resources\Expense as ExpenseResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = Business::business()->get();
        $sales = Sale::sales()->get();
        $expenses = Expense::businessExpenses()->get();
        $daily_sales = Sale::dailySales();
        
        $data = array(
            'daily_sales' => SaleResource::collection($daily_sales),
            'sales' => SaleResource::collection($sales),
            'expenses' => ExpenseResource::collection($expenses),
            'business' => BusinessResource::collection($business)
        );

        $test = Sale::sum('amount');
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sale = $request->isMethod('put') ? Sale::findOrFail ($request->sale_id->sale_id) : new Sale;

        $sale->id = $request->input('sale_id');
        $sale->business_id = $request->input('business_id');
        $sale->amount = $request->input('amount');

        if($sale->save()) 
        {
            return new SaleResource($sale);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        return new SaleResource($sale);
    }

    public function businessSales($id)
    {
        $sales = Sale::businessSales($id)->get();
        
        return SaleResource::collection($sales);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        if($sale->delete())
        {
            return new SaleResource($sale);
        }        
    }
}
