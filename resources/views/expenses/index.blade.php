@extends('adminlte::page')

@section('name', 'csrf-token')

@section('content_header')
    <h1>List Expense</h1>    
@stop

@section('content')
    <div id="app">
        <list_expense></list_expense>
    </div>
@stop