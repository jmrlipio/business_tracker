@extends('adminlte::page')

@section('name', 'csrf-token')

@section('content_header')
    <h1>List Businesses</h1>    
@stop

@section('content')
    <div id="app">
        <list_business></list_business>
    </div>
@stop