@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('name', 'csrf-token')

@section('content_header')
    <h1>Create Sales</h1>    
@stop

@section('content')
    <div id="app">
        <create_sales></create_sales>
    </div>
@stop