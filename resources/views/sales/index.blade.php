@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('name', 'csrf-token')

@section('content_header')
    <h1>List Sales</h1>    
@stop

@section('content')
    <div id="app">
        <list_sales></list_sales>
    </div>
@stop