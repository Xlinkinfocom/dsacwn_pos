@extends('layout.main') @section('content')

@php 
if(!empty($transactions))
{

}
else {
@endphp
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{'No Data exist between this date range!'}}</div>
@php
}
@endphp

@endsection