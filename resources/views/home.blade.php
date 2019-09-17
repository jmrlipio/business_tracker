@extends('adminlte::page')

<!-- @section('title', 'AdminLTE')  FOR NAMING PAGE TITLE INDIVIDUALLY-->
@section('name', 'csrf-token')

@section('content_header')
    <h1>Dashboard</h1>    
@stop

@section('content')
    <div id="app">
        <sales></sales>
    </div>
@stop