@extends('layout.main') @section('content')

@php 
print_r($transactions); 

foreach($transactions as $transaction)
{
    echo $transaction->seller_name;
}

@endphp

@endsection