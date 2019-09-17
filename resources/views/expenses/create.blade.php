@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('name', 'csrf-token')

@section('content_header')
    <h1>Create Expense</h1>    
@stop

@section('content')
    <div id="app">
        <create_expense></create_expense>
    </div>
@stop