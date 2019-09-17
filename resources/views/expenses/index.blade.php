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
@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $('.input[type="checkbox"]').iCheck()
        $('.input[type="radio"]').iCheck()
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
    </script>
@stop