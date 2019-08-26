<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewSalesSynchronizationEvent;
use Illuminate\Support\Facades\Mail;
//use App\Mail\SalesSynchronizationMail;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Mail::to('test@test.com')->send(new SalesSynchronizationMail('test data'));
        //event(new NewSalesSynchronizationEvent('hello world'));
        return view('home');
    }
}
